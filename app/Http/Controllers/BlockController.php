<?php

namespace App\Http\Controllers;

use App\Models\Block;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    public function index() {
        $blocks = Block::paginate(15);
        return view('constructor.blocks.index', compact('blocks'));
    }
}
