# 📌 Job Board Platform  

A **Job Board Platform** built with **Laravel 12, TailwindCSS, Alpine.js, and AI (OpenAI API)**.  
The system supports **multiple user roles**, **resume uploads**, and **AI-powered resume analysis**, deployed using **Laravel Cloud**.

---

## 🚀 Features  

### 👤 User Roles & Dashboards  
- **Admin** → Manage companies, job categories, job vacancies, and view analytics  
- **Company Owner** → Post job vacancies, review applications, shortlist/reject candidates  
- **Job Seeker** → Create a profile, upload resumes, apply for jobs  

### 📂 Job Application Workflow  
- Job seekers can **apply for jobs**  
- Companies can manage applications → Pending / Accepted / Rejected  
- Status indicators: 🟡 Pending | 🟢 Accepted | 🔴 Rejected  

### 🤖 AI Resume Analysis  
- Resumes uploaded to **Laravel Cloud**  
- **Spatie PDF-to-Text** extracts content  
- **OpenAI API** parses skills, evaluates strength, and gives feedback  
- Job seekers receive insights on how to improve their resume  

### 📊 Analytics & Insights  
- Track active job seekers (last 30 days)  
- Job application trends per vacancy  
- Most applied job categories  
- Company-specific applicant statistics  

### 🛠️ Other Features  
- UUIDs for IDs (secure + unique across systems)  
- Soft deletes with restore for companies & jobs  
- Factories, seeders, and migrations for easy testing  
- Modern UI with Tailwind + Alpine  

---

## 🏗️ Tech Stack  

- **Framework**: Laravel 12 (PHP 8.2)  
- **Frontend**: TailwindCSS, Alpine.js  
- **Database**: MariaDB  
- **AI Integration**: OpenAI API (resume parsing & scoring)  
- **File Uploads**: Laravel Cloud (for resume storage)  
- **Libraries**:  
  - [Spatie PDF-to-Text](https://github.com/spatie/pdf-to-text) (extract text from resumes)  
  - Laravel Breeze for authentication  
  - Eloquent ORM for relationships  

---

## 📂 System Design  

- **Users → Companies → Job Vacancies → Applications**  
- Relationships:  
  - One user → one company (company owner)  
  - One company → many job vacancies  
  - One job vacancy → many applications  
  - One user → many applications  

---

## ⚙️ Installation  

1. Clone the repo  
   ```
   git clone https://github.com/itsmutasem/job-board.git
   cd job-board
   ```
2. Install dependencies
```
composer install
npm install && npm run dev
```

3. Set up environment
```
cp .env.example .env
php artisan key:generate
```

Configure DB (DB_CONNECTION=mariadb)

Add OpenAI API key (OPENAI_API_KEY=your_api_key)

Configure Laravel Cloud storage

4. Run migrations & seed data
```
php artisan migrate --seed
```

5. Start the app
```
php artisan serve
```
🧑‍💻 Development Notes

- Uses UUIDs instead of auto-increment IDs

- Implements form requests for validation

- AI integration for resume evaluation

- Optimized with Eloquent queries + relationships

- Soft delete support for companies and vacancies

📈 Roadmap

 - Add email notifications for application updates

 - Improve AI resume feedback (skills matching with job requirements)

 - Export analytics reports as PDF

 - Add job seeker profile dashboard

---


🔗 GitHub Repository: itsmutasem/job-board


---
