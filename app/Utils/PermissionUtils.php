<?php


namespace App\Utils;


class PermissionUtils
{
    /* Roles */
    public const ROLE_SUPERADMIN = 'superadmin';
    public const ROLE_ADMIN = 'admin';
    public const ROLE_SUPPLIER = 'supplier';
    public const ROLE_CUSTOMER = 'customer';

    /* Permissions */
    public const NOVA_ACCESS = 'nova.access';

    public const NOVA_TOOLS_SETTINGS_ACCESS = 'nova.tools.settings.access';
    public const NOVA_RES_USERS_ACCESS = 'nova.resources.users.access';

    public const META_CREDIT_NOTIFICATION = 'user.meta.credit_notification.read';
    public const META_LOW_SMS = 'user.meta.sms_low.read';
    public const META_QUICK_NOTIFY = 'user.meta.quick_notify.read';
    public const META_QUICK_CONTACT = 'user.meta.quick_contact.read';
    public const META_QUICK_REPLY = 'user.meta.quick_reply.read';
}
