**Approval System (Laravel + Temporal)**
- About Project

This is a simple Approval System built using Laravel and Temporal.

User creates a request

Email is sent to manager

Manager approves/rejects using email link

Workflow resumes and updates status

Instead of handling everything in controller, we use Temporal Workflow for better reliability and async processing.

**Flow**
Create Request → Email Sent → Wait for Action → Approve/Reject → Update Status

_Requirements_
- PHP (8+)
- Composer
- Laravel
- Temporal CLI
- RoadRunner

**Installation Steps**
git clone <your-repo-url>
cd approval-system

**Install Dependencies**
composer install

**Run Migration**
php artisan migrate

**Start Temporal Server**
temporal server start-dev

**Start Worker**
./rr.exe serve

**Run Laravel**
php artisan serve

_API Endpoints_
Create Request → POST /api/requests
Approve → GET /api/requests/{id}/approve
Reject → GET /api/requests/{id}/reject
View All → GET /api/requests

**Git Commands (Pull Project)**
Git Commands (Pull / Push)
git clone <repo-url>
cd project-folder
git checkout main
git pull origin main
