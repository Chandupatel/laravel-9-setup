<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function uploadFile($icon, $file_path)
    {
        try {
            $drive = public_path('uploads' . DIRECTORY_SEPARATOR . $file_path);
            $extension = $icon->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;
            $icon->move($drive, $filename);
            $file_url = asset('uploads/' . str_replace('\\', '/', $file_path) . $filename);
            return $file_url;
        } catch (\Throwable$e) {
            print_r($e->getMessage());
            exit();
        }

    }

    public function RemoveFile($image_url)
    {
        try {
            $ImagePath = public_path(str_replace('/', '\\', str_replace(url('/'), '', $image_url)));
            if (\File::exists($ImagePath)) {
                \File::delete($ImagePath);
            }
        } catch (\Throwable$e) {
            print_r($e->getMessage());
            exit();
        }

    }

    public function sendMail($template, $mail_data, $attachments = array())
    {

        $contents = '';
        $contents .= "\n";
        $contents .= date('Y-m-d H:i:s');
        $contents .= "\n";
        $contents .= 'To Email : ' . $mail_data['email'];
        $contents .= "\n";
        $contents .= 'Mail Data : ' . json_encode($mail_data);
        $contents .= "\n";

        try {

            \Mail::send($template, ['data' => $mail_data], function ($message) use ($mail_data, $attachments) {
                $message->to($mail_data['email'], $mail_data['to_name'])
                    ->subject($mail_data['subject'])
                    ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                foreach ($attachments as $file) {
                    $message->attach($file);
                }
            });

            if (\Mail::failures()) {
                $contents .= 'Mail failures :  No Failur Resions';
                $contents .= "\n";
                $contents .= "-----------------------------------------------------------------------------------------------";
                if (file_exists(base_path() . DIRECTORY_SEPARATOR . 'storage/logs' . DIRECTORY_SEPARATOR . 'EmailLogs.txt')) {
                    $contents .= file_get_contents(base_path() . DIRECTORY_SEPARATOR . 'storage/logs' . DIRECTORY_SEPARATOR . 'EmailLogs.txt');
                }
                file_put_contents(base_path() . DIRECTORY_SEPARATOR . 'storage/logs' . DIRECTORY_SEPARATOR . 'EmailLogs.txt', $contents);
                return false;
            } else {
                $contents .= 'Mail Send Successfully';
                $contents .= "\n";
                $contents .= "-----------------------------------------------------------------------------------------------";
                if (file_exists(base_path() . DIRECTORY_SEPARATOR . 'storage/logs' . DIRECTORY_SEPARATOR . 'EmailLogs.txt')) {
                    $contents .= file_get_contents(base_path() . DIRECTORY_SEPARATOR . 'storage/logs' . DIRECTORY_SEPARATOR . 'EmailLogs.txt');
                }
                file_put_contents(base_path() . DIRECTORY_SEPARATOR . 'storage/logs' . DIRECTORY_SEPARATOR . 'EmailLogs.txt', $contents);
                return true;
            }
        } catch (\Throwable$e) {
            $contents .= 'Mail Exception Error :' . $e->getMessage();
            $contents .= "\n";
            $contents .= "-----------------------------------------------------------------------------------------------";
            if (file_exists(base_path() . DIRECTORY_SEPARATOR . 'storage/logs' . DIRECTORY_SEPARATOR . 'EmailLogs.txt')) {
                $contents .= file_get_contents(base_path() . DIRECTORY_SEPARATOR . 'storage/logs' . DIRECTORY_SEPARATOR . 'EmailLogs.txt');
            }
            file_put_contents(base_path() . DIRECTORY_SEPARATOR . 'storage/logs' . DIRECTORY_SEPARATOR . 'EmailLogs.txt', $contents);

            return false;
        }

    }
}
