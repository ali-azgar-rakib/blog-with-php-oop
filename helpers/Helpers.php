<?php
class Helpers
{
    private static function db()
    {
        return new Database();
    }

    public static function formatDate($data)
    {
        return date('F j, Y, g:i a', strtotime($data));
    }

    public static function shortText($text, $length = 300)
    {
        $text = substr($text, 0, $length);
        $text = substr($text, 0, strrpos($text, ' '));
        return $text = $text . '......';
    }

    public static function processData($data)
    {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public static function title()
    {
        $path = $_SERVER['SCRIPT_FILENAME'];
        $path_name = basename($path, '.php');
        if ($path_name == 'index') {
            return 'Home';
        } elseif ($path_name == 'contact') {
            return 'Contact';
        }
    }
}
