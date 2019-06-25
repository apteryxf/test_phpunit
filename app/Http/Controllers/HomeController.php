<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class HomeController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
    public function index()
    {
        $user = Auth::user();
        $g2fa = new Google2FA();
        
        $google2fa = app(Google2FA::class);
        
        $g2faUrl = $google2fa->getQRCodeUrl(
            'pragmarx',
            'google2fa@pragmarx.com',
            $google2fa->generateSecretKey()
        );
        
        $writer = new Writer(
            new ImageRenderer(
                new RendererStyle(400),
                new ImagickImageBackEnd()
                )
            );
            
        $qrcode_image = base64_encode($writer->writeString($g2faUrl));
        
        return view('home', compact('qrcode_image'));
    }
}
