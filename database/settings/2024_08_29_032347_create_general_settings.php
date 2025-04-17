<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.company_name', '');
        $this->migrator->add('general.site_name', '');
        $this->migrator->add('general.phone', '');
        $this->migrator->add('general.email', '');
        $this->migrator->add('general.address', '');
        $this->migrator->add('general.city', '');
        $this->migrator->add('general.country', '');
        $this->migrator->add('general.zip_code', '');
        $this->migrator->add('general.currency', '');
        $this->migrator->add('general.timezone', '');
        $this->migrator->add('general.logo', '');
        $this->migrator->add('general.favicon', '');
    }
};
