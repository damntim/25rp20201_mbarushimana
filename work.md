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
- [ ] Create `.github/workflows/` directory
- [ ] Create `.github/workflows/ci.yml`
- [ ] Add workflow triggers: `on: [push, pull_request]`
- [ ] Add job: Setup PHP 8.1
- [ ] Add step: Checkout code
- [ ] Add step: Run PHP linting `php -l *.php`
- [ ] Add step: Build Docker image
- [ ] Test pipeline by pushing code
- [ ] Take screenshot of successful pipeline run

### Automation (3 marks)
- [ ] Verify pipeline runs automatically on push
- [ ] Verify pipeline runs on PR creation
- [ ] Check pipeline completes all steps successfully
- [ ] Take screenshot of GitHub Actions tab

### Error Handling & Notifications (2 marks)
- [ ] Add failure notification step
- [ ] Add success status badge to README
- [ ] Test pipeline with intentional error
- [ ] Document error handling in workflow

### Security (1 mark)
- [DONE] Create Docker Hub account
- [DONE] Add GitHub Secret: `DOCKERHUB_USERNAME`
- [DONE] Add GitHub Secret: `DOCKERHUB_TOKEN`
- [] Use secrets in workflow: `${{ secrets.DOCKERHUB_TOKEN }}`

---

## 📋 Phase 5: Containerization & Registry (10 marks)

### Dockerfile Quality (3 marks)
- [ ] Create `Dockerfile` in project root
- [ ] Use base image: `FROM php:8.1-apache`
- [ ] Set working directory: `WORKDIR /var/www/html`
- [ ] Copy application files: `COPY . .`
- [ ] Set data directory permissions: `RUN chown -R www-data:www-data data/`
- [ ] Expose port: `EXPOSE 80`
- [ ] Test Dockerfile builds successfully

### Image Management (3 marks)
- [ ] Build image: `docker build -t 25rp20201/patient-mgmt:v1.0 .`
- [ ] Test image locally: `docker run -d -p 8080:80 25rp20201/patient-mgmt:v1.0`
- [ ] Verify application works in container
- [ ] Login to Docker Hub: `docker login`
- [ ] Push image: `docker push 25rp20201/patient-mgmt:v1.0`
- [ ] Take screenshot of Docker Hub repository

### Container Lifecycle (2 marks)
- [ ] Run container: `docker run -d --name patient-app patient-mgmt:v1.0`
- [ ] Check running containers: `docker ps`
- [ ] View logs: `docker logs patient-app`
- [ ] Stop container: `docker stop patient-app`
- [ ] Remove container: `docker rm patient-app`
- [ ] Take screenshots of each command output

### Best Practices (2 marks)
- [ ] Create `.dockerignore` file
- [ ] Add `.git/`, `node_modules/`, `*.md` to `.dockerignore`
- [ ] Use minimal base image (alpine if possible)
- [ ] Document Docker commands in README

---

## 📋 Phase 6: Kubernetes Deployment (10 marks)

### Kubernetes Manifest Files (4 marks)
- [ ] Create `k8s/` directory
- [ ] Create `k8s/namespace.yml`:
  ```yaml
  apiVersion: v1
  kind: Namespace
  metadata:
    name: student-25rp20201
  ```
- [ ] Create `k8s/pvc.yml` (PersistentVolumeClaim for data)
- [ ] Create `k8s/configmap.yml` (application config)
- [ ] Create `k8s/deployment.yml` (2 replicas)
- [ ] Create `k8s/service.yml` (LoadBalancer type)
- [ ] Add health checks (liveness and readiness probes)

### Deployment Execution (3 marks)
- [ ] Create namespace: `kubectl create namespace student-25rp20201`
- [ ] Apply all manifests: `kubectl apply -f k8s/`
- [ ] Verify namespace: `kubectl get namespaces`
- [ ] Check deployments: `kubectl get deployments -n student-25rp20201`
- [ ] Check pods: `kubectl get pods -n student-25rp20201`
- [ ] Check services: `kubectl get services -n student-25rp20201`
- [ ] Take screenshots of all outputs

### Scalability (2 marks)
- [ ] Scale deployment: `kubectl scale deployment patient-app --replicas=3 -n student-25rp20201`
- [ ] Verify scaling: `kubectl get pods -n student-25rp20201`
- [ ] Scale back to 2 replicas
- [ ] Take screenshots showing scaling

### Rollback & Recovery (1 mark)
- [ ] Check rollout history: `kubectl rollout history deployment/patient-app -n student-25rp20201`
- [ ] Perform rollback: `kubectl rollout undo deployment/patient-app -n student-25rp20201`
- [ ] Verify rollback successful
- [ ] Document rollback procedure

---

## 📋 Phase 7: Monitoring & Reliability (10 marks)

### Metrics & Logging (4 marks)
- [ ] View pod logs: `kubectl logs -f deployment/patient-app -n student-25rp20201`
- [ ] Check resource usage: `kubectl top pods -n student-25rp20201`
- [ ] Monitor pod status: `kubectl get pods -w -n student-25rp20201`
- [ ] Export logs to file for documentation
- [ ] Take screenshots of log outputs

### Health Checks (2 marks)
- [ ] Verify liveness probe in deployment.yml
- [ ] Verify readiness probe in deployment.yml
- [ ] Test health checks by describing pod
- [ ] Simulate pod failure and check restart
- [ ] Take screenshot of probe configuration

### Alerting & Monitoring (3 marks)
- [ ] Set up basic monitoring checklist
- [ ] Monitor pod restart count
- [ ] Check for resource limit warnings
- [ ] Document alert thresholds (CPU > 80%, Memory > 90%)
- [ ] Create monitoring dashboard (manual or screenshot based)

### Incident Response (1 mark)
- [ ] Create `docs/troubleshooting.md`
- [ ] Document common issues and solutions:
  - Pod CrashLoopBackOff
  - ImagePullBackOff
  - Permission denied on data directory
  - Service not accessible
- [ ] Add debugging commands reference

---

## 📋 Phase 8: Documentation & Report (10 marks)

### Structure & Clarity (5 marks)
- [ ] Create comprehensive `README.md` with:
  - Project overview
  - Architecture diagram
  - Prerequisites
  - Installation steps
  - Usage instructions
  - API documentation
- [ ] Create `docs/architecture.md` with system diagram
- [ ] Create `docs/deployment-guide.md`
- [ ] Use proper markdown formatting
- [ ] Add table of contents

### Technical Depth (3 marks)
- [ ] Include architecture diagram (draw.io or similar)
- [ ] Add screenshots for each phase
- [ ] Document all commands used
- [ ] Explain design decisions
- [ ] Include code snippets with explanations

### References (2 marks)
- [ ] Cite Docker documentation
- [ ] Cite Kubernetes documentation
- [ ] Cite GitHub Actions documentation
- [ ] Add links to all external resources
- [ ] Create bibliography section

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
```
25rp20201-patient-management/
├── index.php
├── api.php
├── Patient.php
├── config.php
├── data/patients.json
├── Dockerfile
├── docker-compose.yml
├── .dockerignore
├── .gitignore
├── composer.json
├── k8s/
│   ├── namespace.yml
│   ├── deployment.yml
│   ├── service.yml
│   ├── pvc.yml
│   └── configmap.yml
├── .github/
│   └── workflows/
│       ├── ci.yml
│       └── cd.yml
├── docs/
│   ├── infrastructure-setup.md
│   ├── architecture.md
│   ├── deployment-guide.md
│   ├── troubleshooting.md
│   └── screenshots/
├── README.md
└── LICENSE

**Last Updated:** December 2025  
**Version:** 1.0  
**Student ID:** 25RP20201