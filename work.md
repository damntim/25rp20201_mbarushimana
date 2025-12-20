# DevOps Patient Management - Implementation Checklist
**Student:** 25RP20201 - Mbarushimana  
**Project:** Complete DevOps Lifecycle Implementation

---

## 📋 Phase 2: Version Control & Git Workflow (10 marks)

### Repository Setup (3 marks)
- [DONE] Create GitHub account (if needed)
- [DONE] Create repository: `25rp20201-patient-management`
- [DONE] Initialize local Git repo: `git init`
- [DONE] Configure Git user: `git config user.name` and `git config user.email`
- [DONE] Connect to remote: `git remote add origin <URL>`
- [DONE] Create `.gitignore` file (ignore `data/*.json`, `.env`, etc.)
- [DONE] Take screenshot of GitHub repository page

### Branching Strategy (3 marks)
- [DONE] Create `main` branch (production)
- [DONE] Create `develop` branch: `git checkout -b develop`
- [DONE] Create feature branch: `git checkout -b feature/patient-api`
- [DONE] Document branching strategy in README
- [DONE] Take screenshot showing branch structure

### Commit Quality (2 marks)
- [DONE] Make initial commit with project structure
- [DONE] Use conventional commit messages (feat:, fix:, docs:)
- [DONE] Example: `git commit -m "feat: add patient form interface"`
- [DONE] Example: `git commit -m "fix: resolve JSON file permissions"`
- [DONE] Push commits: `git push origin develop`
- [DONE] Take screenshot of commit history

### Pull Requests & Collaboration (2 marks)
- [DONE] Create Pull Request from `feature/patient-api` to `develop`
- [DONE] Add PR description explaining changes
- [DONE] Merge PR to `develop`
- [DONE] Create PR from `develop` to `main` for production
- [DONE] Take screenshots of PR process

---

## 📋 Phase 3: Application Development

### Core Files Setup
- [DONE] Create `index.php` (main page with patient form)
- [DONE] Create `api.php` (API endpoints handler)
- [DONE] Create `Patient.php` (patient model class)
- [DONE] Create `config.php` (application configuration)
- [DONE] Create `data/patients.json` (empty array initially)
- [DONE] Create `composer.json` (if using dependencies)

### Application Features
- [DONE] Implement patient form (Name, Age, Email, Condition)
- [DONE] Add form validation (client and server side)
- [DONE] Create API endpoint: POST `/api.php?action=add`
- [DONE] Create API endpoint: GET `/api.php?action=list`
- [DONE] Create API endpoint: GET `/api.php?action=get&id=X`
- [DONE] Style with Tailwind CSS (CDN)
- [DONE] Test locally: `php -S localhost:8000`
- [DONE] Take screenshots of working application

### Database Setup
- [DONE] Create `data/` directory
- [DONE] Initialize `patients.json` with empty structure:
  ```json
  {"patients": []}
  ```
- [DONE] Set proper permissions: `chmod 777 data/`
- [ ] Test write operations locally

---

## 📋 Phase 4: CI Pipeline Implementation (10 marks)

### Pipeline Configuration (4 marks)
- [DONE] Create `.github/workflows/` directory
- [DONE] Create `.github/workflows/ci.yml`
- [DONE] Add workflow triggers: `on: [push, pull_request]`
- [DONE] Add job: Setup PHP 8.1
- [DONE] Add step: Checkout code
- [DONE] Add step: Run PHP linting `php -l *.php`
- [DONE] Add step: Build Docker image
- [DONE] Test pipeline by pushing code
- [DONE] Take screenshot of successful pipeline run

### Automation (3 marks)
- [DONE] Verify pipeline runs automatically on push
- [DONE] Verify pipeline runs on PR creation
- [DONE] Check pipeline completes all steps successfully
- [DONE] Take screenshot of GitHub Actions tab

### Error Handling & Notifications (2 marks)
- [DONE] Add failure notification step
- [DONE] Add success status badge to README
- [DONE] Test pipeline with intentional error
- [DONE] Document error handling in workflow

### Security (1 mark)
- [DONE] Create Docker Hub account
- [DONE] Add GitHub Secret: `DOCKERHUB_USERNAME`
- [DONE] Add GitHub Secret: `DOCKERHUB_TOKEN`
- [DONE] Use secrets in workflow: `${{ secrets.DOCKERHUB_TOKEN }}`

---
# DevOps Patient Management - Implementation Checklist
**Student:** 25RP20201 - Mbarushimana  
**Project:** Complete DevOps Lifecycle Implementation

---

## 📋 Phase 2: Version Control & Git Workflow (10 marks)

### Repository Setup (3 marks)
- [DONE] Create GitHub account (if needed)
- [DONE] Create repository: `25rp20201-patient-management`
- [DONE] Initialize local Git repo: `git init`
- [DONE] Configure Git user: `git config user.name` and `git config user.email`
- [DONE] Connect to remote: `git remote add origin <URL>`
- [DONE] Create `.gitignore` file (ignore `data/*.json`, `.env`, etc.)
- [DONE] Take screenshot of GitHub repository page

### Branching Strategy (3 marks)
- [DONE] Create `main` branch (production)
- [DONE] Create `develop` branch: `git checkout -b develop`
- [DONE] Create feature branch: `git checkout -b feature/patient-api`
- [DONE] Document branching strategy in README
- [DONE] Take screenshot showing branch structure

### Commit Quality (2 marks)
- [DONE] Make initial commit with project structure
- [DONE] Use conventional commit messages (feat:, fix:, docs:)
- [DONE] Example: `git commit -m "feat: add patient form interface"`
- [DONE] Example: `git commit -m "fix: resolve JSON file permissions"`
- [DONE] Push commits: `git push origin develop`
- [DONE] Take screenshot of commit history

### Pull Requests & Collaboration (2 marks)
- [DONE] Create Pull Request from `feature/patient-api` to `develop`
- [DONE] Add PR description explaining changes
- [DONE] Merge PR to `develop`
- [DONE] Create PR from `develop` to `main` for production
- [DONE] Take screenshots of PR process

---

## 📋 Phase 3: Application Development

### Core Files Setup
- [DONE] Create `index.php` (main page with patient form)
- [DONE] Create `api.php` (API endpoints handler)
- [DONE] Create `Patient.php` (patient model class)
- [DONE] Create `config.php` (application configuration)
- [DONE] Create `data/patients.json` (empty array initially)
- [DONE] Create `composer.json` (if using dependencies)

### Application Features
- [DONE] Implement patient form (Name, Age, Email, Condition)
- [DONE] Add form validation (client and server side)
- [DONE] Create API endpoint: POST `/api.php?action=add`
- [DONE] Create API endpoint: GET `/api.php?action=list`
- [DONE] Create API endpoint: GET `/api.php?action=get&id=X`
- [DONE] Style with Tailwind CSS (CDN)
- [DONE] Test locally: `php -S localhost:8000`
- [DONE] Take screenshots of working application

### Database Setup
- [DONE] Create `data/` directory
- [DONE] Initialize `patients.json` with empty structure:
  ```json
  {"patients": []}
  ```
- [DONE] Set proper permissions: `chmod 777 data/`
- [ ] Test write operations locally

---

## 📋 Phase 4: CI Pipeline Implementation (10 marks)

### Pipeline Configuration (4 marks)
- [DONE] Create `.github/workflows/` directory
- [DONE] Create `.github/workflows/ci.yml`
- [DONE] Add workflow triggers: `on: [push, pull_request]`
- [DONE] Add job: Setup PHP 8.1
- [DONE] Add step: Checkout code
- [DONE] Add step: Run PHP linting `php -l *.php`
- [DONE] Add step: Build Docker image
- [DONE] Test pipeline by pushing code
- [DONE] Take screenshot of successful pipeline run

### Automation (3 marks)
- [DONE] Verify pipeline runs automatically on push
- [DONE] Verify pipeline runs on PR creation
- [DONE] Check pipeline completes all steps successfully
- [DONE] Take screenshot of GitHub Actions tab

### Error Handling & Notifications (2 marks)
- [DONE] Add failure notification step
- [DONE] Add success status badge to README
- [DONE] Test pipeline with intentional error
- [DONE] Document error handling in workflow

### Security (1 mark)
- [DONE] Create Docker Hub account
- [DONE] Add GitHub Secret: `DOCKERHUB_USERNAME`
- [DONE] Add GitHub Secret: `DOCKERHUB_TOKEN`
- [DONE] Use secrets in workflow: `${{ secrets.DOCKERHUB_TOKEN }}`

---
## 📋 Phase 5: Containerization & Registry (10 marks) — Completed
> Status: Completed. Proceeding to Phase 6.

### Dockerfile Quality (3 marks)
- [DONE] Create `Dockerfile` in project root
- [DONE] Use base image: `FROM php:8.1-apache`
- [DONE] Set working directory: `WORKDIR /var/www/html`
- [DONE] Copy application files: `COPY . .`
- [DONE] Set data directory permissions: `RUN chown -R www-data:www-data data/`
- [DONE] Expose port: `EXPOSE 80`
- [DONE] Test Dockerfile builds successfully

### Image Management (3 marks)
- [DONE] Build image:  
  `docker build -t damntime/25rp20201_mbarushimana:v1.0 .`
- [DONE] Test image locally:  
  `docker run -d -p 8080:80 damntime/25rp20201_mbarushimana:v1.0`
- [DONE] Verify application works in container
- [DONE] Login to Docker Hub:  
  `docker login`
- [DONE] Push image:  
  `docker push damntime/25rp20201_mbarushimana:v1.0`
- [DONE] Take screenshot of Docker Hub repository

### Container Lifecycle (2 marks)
- [DONE] Run container:  
  `docker run -d --name patient-app damntime/25rp20201_mbarushimana:v1.0`
- [DONE] Check running containers:  
  `docker ps`
- [DONE] View logs:  
  `docker logs patient-app`
- [DONE] Stop container:  
  `docker stop patient-app`
- [DONE] Remove container:  
  `docker rm patient-app`
- [DONE] Take screenshots of each command output

### Best Practices (2 marks)
- [DONE] Create `.dockerignore` file
- [DONE] Add `.git/`, `node_modules/`, `*.md` to `.dockerignore`
- [DONE] Use minimal base image (alpine if possible)
- [DONE] Document Docker commands in README

---
## 📋 Phase 6: Kubernetes Deployment (10 marks)
> Status: Next focus (to start)

### Rollback & Recovery (1 mark)
- [DONE] Check rollout history: `kubectl rollout history deployment/patient-app -n student-25rp20201`
- [ ] Perform rollback: `kubectl rollout undo deployment/patient-app -n student-25rp20201`
- [DONE] Document rollback procedure

---
## 📋 Phase 7: Monitoring & Reliability (10 marks)
> Status: Completed. Proceeding to Phase 8.

### Metrics & Logging (4 marks)
- [DONE] View pod logs: `kubectl logs -f deployment/patient-app -n student-25rp20201`
- [DONE] Check resource usage: `kubectl top pods -n student-25rp20201`
- [DONE] Monitor pod status: `kubectl get pods -w -n student-25rp20201`
- [DONE] Export logs to file for documentation
- [DONE] Take screenshots of log outputs

### Health Checks (2 marks)
- [DONE] Verify liveness probe in deployment.yml
- [DONE] Verify readiness probe in deployment.yml
- [DONE] Test health checks by describing pod
- [DONE] Simulate pod failure and check restart
- [DONE] Take screenshot of probe configuration

### Alerting & Monitoring (3 marks)
- [DONE] Set up basic monitoring checklist
- [DONE] Monitor pod restart count
- [DONE] Check for resource limit warnings
- [DONE] Document alert thresholds (CPU > 80%, Memory > 90%)
- [DONE] Create monitoring dashboard (manual or screenshot based)

### Incident Response (1 mark)
- [DONE] Create `docs/troubleshooting.md`
- [DONE] Document common issues and solutions:
  - Pod CrashLoopBackOff
  - ImagePullBackOff
  - Permission denied on data directory
  - Service not accessible
- [DONE] Add debugging commands reference

---
## 📋 Phase 8: Documentation & Report (10 marks)
> Status: In progress

### Structure & Clarity (5 marks)
- [DONE] Create comprehensive `README.md` with:
  - Project overview
  - Architecture diagram (placeholder linked)
  - Prerequisites
  - Installation steps
  - Usage instructions
  - API documentation
- [DONE] Create `docs/architecture.md` with system diagram description
- [DONE] Create `docs/deployment-guide.md`
- [DONE] Use proper markdown formatting
- [DONE] Add table of contents

### Technical Depth (3 marks)
- [IN-PROGRESS] Include architecture diagram (draw.io or similar) — add `docs/architecture.png`
- [IN-PROGRESS] Add screenshots for each phase — place in `docs/screenshots/`
- [DONE] Document all commands used
- [DONE] Explain design decisions
- [DONE] Include code snippets with explanations

### References (2 marks)
- [DONE] Cite Docker documentation
- [DONE] Cite Kubernetes documentation
- [DONE] Cite GitHub Actions documentation
- [DONE] Add links to all external resources
- [DONE] Create bibliography section

---
## 📋 Phase 9: CI/CD Automation (Bonus)

### Extended Pipeline
- [ ] Create `.github/workflows/cd.yml` for continuous deployment
- [ ] Add automated Docker build on merge to main
- [ ] Add automated push to Docker Hub with tags
- [ ] Add automated deployment to Kubernetes
- [ ] Add smoke tests after deployment

### Pipeline Security
- [ ] Use GitHub Secrets for all credentials
- [ ] Implement least privilege access
- [ ] Add security scanning (optional)

---

## 📋 Phase 10: Final Checks & Submission

### Quality Assurance
- [ ] Test complete workflow end-to-end
- [ ] Verify all phases are documented
- [ ] Check all screenshots are clear and labeled
- [ ] Validate all commands work as documented
- [ ] Proofread all documentation

### Deliverables Checklist
- [ ] GitHub repository URL accessible
- [ ] Docker Hub repository public
- [ ] All K8s manifests in repo
- [ ] CI/CD pipelines functional
- [ ] Complete documentation
- [ ] Architecture diagrams included
- [ ] Screenshots organized in `docs/screenshots/`
- [ ] Video demo (optional but recommended)

### Repository Structure Verification