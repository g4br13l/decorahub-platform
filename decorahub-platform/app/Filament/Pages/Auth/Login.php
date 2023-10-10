<?php

namespace App\Filament\Pages\Auth;


use Filament\Forms\Form;
use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Contracts\Support\Htmlable;

class Login extends BaseLogin
{

    /*protected static string $view = 'filament.pages.auth.login';*/

    public function getHeading(): string | Htmlable {return '';}


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ]);
    }

}
