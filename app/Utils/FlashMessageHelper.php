<?php

namespace App\Utils;

class FlashMessageHelper
{

    // data example :
    // WITH TITLE
    // $data = [
    //      "bg" => "success",
    //      "icon" => "plus",
    //      "title" => "Berhasilll!",
    //      "text" => "Berhasil menambahkan data!"
    //          ]
    // ---- OR ----
    // WITHOUT TITLE
    // $data = [
    //      "class" => "alert-success",
    //      "icon" => "plus",
    //      "text" => "Berhasil menambahkan data!"
    //          ]

    public static function bootstrapAlert($data)
    {
        if (isset($data['bg']))
            session()->flash('alert-bg', $data['bg']);
        if (isset($data['class']))
            session()->flash('alert-class', $data['class']);
        if (isset($data['icon']))
            session()->flash('alert-icon', $data['icon']);
        if (isset($data['title']))
            session()->flash('alert-title', $data['title']);
        if (isset($data['text']))
            session()->flash('alert-text', $data['text']);
    }

    public static function bootstrapSuccessAlert($message)
    {
        session()->flash('alert-class', 'alert-success');
        session()->flash('alert-icon', 'check');
        session()->flash('alert-text', $message);
    }

    public static function bootstrapDangerAlert($message)
    {
        session()->flash('alert-class', 'alert-danger');
        session()->flash('alert-icon', 'times');
        session()->flash('alert-text', $message);
    }
}
