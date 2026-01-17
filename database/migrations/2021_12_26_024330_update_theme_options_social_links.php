<?php

use Botble\Setting\Models\Setting;
use Illuminate\Database\Migrations\Migration;

class UpdateThemeOptionsSocialLinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $theme = Theme::getThemeName();

        $socialLinks = [];

        if (theme_option('facebook')) {
            $socialLinks[] = [
                [
                    'key'   => 'social-name',
                    'value' => 'Facebook',
                ],
                [
                    'key'   => 'social-icon',
                    'value' => 'ion-social-facebook',
                ],
                [
                    'key'   => 'social-url',
                    'value' => theme_option('facebook'),
                ],
                [
                    'key'   => 'social-color',
                    'value' => '#3b5998',
                ],
            ];
        }

        if (theme_option('twitter')) {
            $socialLinks[] = [
                [
                    'key'   => 'social-name',
                    'value' => 'Twitter',
                ],
                [
                    'key'   => 'social-icon',
                    'value' => 'ion-social-twitter',
                ],
                [
                    'key'   => 'social-url',
                    'value' => theme_option('twitter'),
                ],
                [
                    'key'   => 'social-color',
                    'value' => '#00acee',
                ],
            ];
        }

        if (theme_option('youtube')) {
            $socialLinks[] = [
                [
                    'key'   => 'social-name',
                    'value' => 'Youtube',
                ],
                [
                    'key'   => 'social-icon',
                    'value' => 'ion-social-youtube',
                ],
                [
                    'key'   => 'social-url',
                    'value' => theme_option('youtube'),
                ],
                [
                    'key'   => 'social-color',
                    'value' => '#c4302b',
                ],
            ];
        }

        if (theme_option('instagram')) {
            $socialLinks[] = [
                [
                    'key'   => 'social-name',
                    'value' => 'Instagram',
                ],
                [
                    'key'   => 'social-icon',
                    'value' => 'ion-social-instagram',
                ],
                [
                    'key'   => 'social-url',
                    'value' => theme_option('instagram'),
                ],
                [
                    'key'   => 'social-color',
                    'value' => '#3f729b',
                ],
            ];
        }

        if (count($socialLinks)) {
            Setting::insertOrIgnore([
                'key'   => 'theme-' . $theme . '-social_links',
                'value' => json_encode($socialLinks),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
