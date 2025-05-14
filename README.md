# Task Manager API - Laravel 12

نظام إدارة مهام بسيط مبني باستخدام Laravel 12، يعتمد على api ويدعم المصادقة باستخدام Laravel Sanctum، مع نظام صلاحيات مبسط، وعلاقات بين الجداول.

---

 المميزات الأساسية

 تسجيل الدخول والخروج باستخدام Laravel Sanctum CRUD كامل للمهام (Tasks)
 إدارة حالات المهام (Statuses) - للمدير فقط
 التفويض المبني على الأدوار (Role-based Authorization)
التحقق من صحة البيانات باستخدام Form Requests
 علاقات Eloquent بين النماذج (User - Task - Status)


---

 بنية الجداول

- **Users**: `id`, `name`, `email`, `password`, `role`
- **Tasks**: `id`, `title`, `description`, `status_id`, `user_id`
- **Statuses**: `id`, `name`

---

تثبيت وتشغيل المشروع

```bash
git clone https://github.com/alaashabano/task-manager-api.git
cd task-manager-api

composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
