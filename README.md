**Approval System (Laravel + Temporal)**
- Overview

This project is a workflow-driven approval system built using Laravel and Temporal.

Instead of handling approval logic directly in controllers, the system uses Temporal workflows to manage the process asynchronously and reliably.

Features
- User Create requests
- Email notification to manager
- Approve / Reject via email links
- Workflow-based processing using Temporal
- Signal-driven decision handling
- Activity-based DB updates

**Workflow Logic**
_Step-by-step flow_:

User creates request
Workflow starts (PR-<id>)
Activity sends email to manager
Workflow waits for signal
Manager clicks approve/reject link
Laravel sends signal to workflow
Workflow resumes
Activity updates DB status
Workflow completes


Key Concepts Used

 -> Workflow

Controls the approval process

Waits for decision using:

yield Workflow::await(...)
 -> Activities

Perform actual tasks:

Send email

Update database

-> Signals

Used to resume workflow:

approve()
reject()
->Task Queue

request-queue used to distribute tasks to workers

Setup Instructions
1- Install Dependencies

composer install
2️- Configure Environment

Update .env:

APP_URL=http://localhost:8000

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email
3️- Run Database Migration
php artisan migrate
4️- Start Temporal Server
temporal server start-dev
5️- Start Worker
./rr.exe serve

6️- Run Laravel Server
php artisan serve

API Endpoints

-> Create Request
POST /api/requests

-> Approve Request
GET /api/requests/{id}/approve

-> Reject Request
GET /api/requests/{id}/reject

-> View Requests
GET /api/requests
GET /api/requests/{id}
