<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Link;

class LinkController extends Controller
{
    public function index() {
        $data = Link::orderBy('created_at', 'desc')->take(10)->get();
        
        return $data;
    }

    public function handle($short_link) {
        if (!Link::where('short_link', $short_link)->latest()->first()) {
            return false;
        }
        
        $base_link = Link::where('short_link', $short_link)->latest()->first()->base_link;

        return response(redirect($base_link));
    }

    public function store(Request $request) {
        $base_link = $request->base_link;
        
        $free_link = $this->getFreeLink();
        
        $data = [
            'base_link' => $base_link,
            'short_link' => $this->getNextCharacter($free_link),
        ];
        
        $short_link = Link::create($data);
        $short_link->save();
        
        return $short_link->getFullLink($short_link->short_link) ?? false;
    }
    
    private function getFreeLink() {
        $last_link = Link::latest()->first();
        
        if (!$last_link) {
            return 'a';
        }
        
        $last_link = $last_link->short_link;
        
        return $last_link;
    }
    
    private function getNextCharacter($char) {
        $length = strlen($char);
        $lastChar = $char[$length - 1];

        if ($lastChar >= 'a' && $lastChar < 'z') {
            $char[$length - 1] = chr(ord($lastChar) + 1);
            return $char;
        } elseif ($lastChar == 'z') {
            if ($length == 1) {
                return 'aa';
            } else {
                $char = substr($char, 0, $length - 1);
                return getNextCharacter($char) . 'a';
            }
        } else {
            return $char;
        }
    }
}
