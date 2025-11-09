<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role_id')) {
                $table->unsignedBigInteger('role_id')->nullable()->after('id');
            }
            if (!Schema::hasColumn('users', 'cpf')) {
                $table->string('cpf')->nullable()->after('password');
            }
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->after('cpf');
            }
            if (!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('users', 'digital_certificate')) {
                $table->text('digital_certificate')->nullable()->after('avatar');
            }
            if (!Schema::hasColumn('users', 'certificate_serial')) {
                $table->string('certificate_serial')->nullable()->after('digital_certificate');
            }
            if (!Schema::hasColumn('users', 'certificate_valid_from')) {
                $table->date('certificate_valid_from')->nullable()->after('certificate_serial');
            }
            if (!Schema::hasColumn('users', 'certificate_valid_until')) {
                $table->date('certificate_valid_until')->nullable()->after('certificate_valid_from');
            }
            if (!Schema::hasColumn('users', 'certificate_issuer')) {
                $table->string('certificate_issuer')->nullable()->after('certificate_valid_until');
            }
            if (!Schema::hasColumn('users', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('certificate_issuer');
            }
            if (!Schema::hasColumn('users', 'last_login_at')) {
                $table->timestamp('last_login_at')->nullable()->after('is_active');
            }
            if (!Schema::hasColumn('users', 'last_login_ip')) {
                $table->string('last_login_ip')->nullable()->after('last_login_at');
            }
            if (!Schema::hasColumn('users', 'failed_login_attempts')) {
                $table->unsignedInteger('failed_login_attempts')->default(0)->after('last_login_ip');
            }
            if (!Schema::hasColumn('users', 'locked_until')) {
                $table->timestamp('locked_until')->nullable()->after('failed_login_attempts');
            }
            if (!Schema::hasColumn('users', 'locale')) {
                $table->string('locale')->nullable()->after('locked_until');
            }
            if (!Schema::hasColumn('users', 'timezone')) {
                $table->string('timezone')->nullable()->after('locale');
            }
            if (!Schema::hasColumn('users', 'theme')) {
                $table->string('theme')->nullable()->after('timezone');
            }
            if (!Schema::hasColumn('users', 'email_notifications')) {
                $table->boolean('email_notifications')->default(true)->after('theme');
            }
            if (!Schema::hasColumn('users', 'notification_preferences')) {
                $table->json('notification_preferences')->nullable()->after('email_notifications');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role_id', 'cpf', 'phone', 'avatar', 'digital_certificate', 'certificate_serial',
                'certificate_valid_from', 'certificate_valid_until', 'certificate_issuer', 'is_active',
                'last_login_at', 'last_login_ip', 'failed_login_attempts', 'locked_until', 'locale',
                'timezone', 'theme', 'email_notifications', 'notification_preferences'
            ]);
        });
    }
};
