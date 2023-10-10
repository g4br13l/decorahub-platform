<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use \Filament\Pages\Auth\EditProfile as BaseEditProfile;

class EditProfile extends BaseEditProfile
{

    protected static string $layout = 'filament-panels::components.layout.index';
    protected static string $view = 'filament.pages.auth.edit-profile';
    /*public static function getSlug(): string {return static::$slug ?? 'perfil';}*/


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Perfil do usuário')->schema([
                    FileUpload::make('photo')->image(),
                    $this->getNameFormComponent(),
                    $this->getEmailFormComponent(),
                    $this->getPasswordFormComponent(),
                    $this->getPasswordConfirmationFormComponent(),
                ])
            ]);
    }

}
