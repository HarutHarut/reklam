<?php

namespace App\Services;

use App\Models\Emails;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmailCreateService
 * @package App\Services
 */
class EmailCreateService
{
    public static function create($userToId, $toEmail, $subject, $content,  $templateName, $emailType, $fromEmail = null, $attachment = null) : Model
    {
        return Emails::query()->create([
            'user_to_id' => $userToId,
            'from_email' => $fromEmail ?? config('mail.default_mail'),
            'to_email' => $toEmail,
            'subject' => $subject,
            'content' => $content,
            'template_name' => $templateName,
            'email_type' => $emailType,
            'attachment' => $attachment,
        ]);
    }
}
