# DevOps Complete Workflow Guide
**Project:** Patient Management System  
**DevOps Identifier:** `25rp20201_mbarushimana`  
**Student:** 25rp20201 - Mbarushimana  
**Environment:** WSL, Docker Desktop, Kubernetes, GitHub

---

## 🎯 Project Overview
A simple Patient Management System demonstrating the complete DevOps lifecycle. The application allows adding and retrieving patient information through a web interface.

**Application Stack:**
- **Frontend:** HTML/Tailwind CSS/JavaScript (Simple form)
- **Backend:** PHP (RESTful API)
- **Database:** MySQL
- **Architecture:** Microservices (Frontend + Backend + Database)

---

## 📋 DevOps Workflow - All 10 Phases

### **PHASE 1: Infrastructure Setup** 
**Objective:** Set up the development environment using WSL and virtual environments

**Tools:** WSL2, Docker Desktop, Kubernetes (Docker Desktop)

**Tasks:**
1. ✅ Install and configure WSL2 on Windows
2. ✅ Install Docker Desktop with WSL2 backend
3. ✅ Enable Kubernetes in Docker Desktop
4. ✅ Install required tools:
   - Git
   - PHP (CLI)
   - Composer
   - kubectl
   - Docker CLI
5. ✅ Verify installations with version checks

**Deliverables:**
- Screenshots of successful installations
- Output of version commands (`php -v`, `docker --version`, `kubectl version`)
- Environment setup documentation

---

### **PHASE 2: Version Control & Git Workflow**
**Objective:** Implement proper version control and branching strategy

**Tools:** GitHub

**Tasks:**
1. ✅ Create GitHub repository: `25rp20201_mbarushimana-patient-management`
2. ✅ Initialize local Git repository
3. ✅ Implement branching strategy:
   - `main` branch (production)
   - `develop` branch (development)
   - `feature/*` branches (new features)
4. ✅ Create `.gitignore` file
5. ✅ Make initial commit with project structure
6. ✅ Push to remote repository

**Branching Strategy:**
```
main (production-ready)
  └── develop (integration)
       ├── feature/patient-form
       ├── feature/api-endpoints
       └── feature/database-setup
```

**Deliverables:**
- Repository URL
- Screenshots of Git workflow
- Commit history
- Branch structure diagram

---

### **PHASE 3: Application Development**
**Objective:** Develop the Patient Management System

**Components:**

#### **3.1 Backend API (PHP)**
**Files:**
- `backend/index.php` - Main entry point
- `backend/config/database.php` - Database connection
- `backend/api/patients.php` - API endpoints handler
- `backend/models/Patient.php` - Patient model class
- `backend/composer.json` - Dependencies

**API Endpoints:**
- `POST /api/patients.php` - Add new patient
- `GET /api/patients.php` - Get all patients
- `GET /api/patients.php?id=X` - Get patient by ID

#### **3.2 Frontend (HTML/Tailwind CSS/JS)**
**Files:**
- `frontend/index.html` - Main page with Tailwind CDN
- `frontend/app.js` - Frontend logic (Fetch API calls)

**Features:**
- Form to add patient (Name, Age, Email, Condition)
- Display list of patients in cards
- Responsive design with Tailwind CSS
- Modern UI with gradient backgrounds

#### **3.3 Database**
- MySQL for data storage
- Patient table: id, name, age, email, condition, created_at

**Deliverables:**
- Source code for all components
- Local testing screenshots
- API testing with Postman/curl
- MySQL database schema export

---

### **PHASE 4: Continuous Integration (CI)**
**Objective:** Automate build and testing process

**Tools:** GitHub Actions

**Tasks:**
1. Create `.github/workflows/ci.yml`
2. Configure CI pipeline:
   - Trigger on push to `develop` and `main`
   - Install PHP dependencies with Composer
   - Run PHP linting (PHP CodeSniffer)
   - Run unit tests (PHPUnit - basic tests)
   - Build Docker images
   - Push images to Docker Hub
3. Add status badges to README

**CI Pipeline Steps:**
```yaml
Build → Test → Lint → Docker Build → Push to Registry
```

**Deliverables:**
- GitHub Actions workflow file
- CI pipeline run screenshots
- Test results
- Docker Hub repository links

---

### **PHASE 5: Containerization (Docker)**
**Objective:** Package applications into Docker containers

**Tools:** Docker, Docker Compose, Docker Hub

**Tasks:**
1. Create Dockerfiles for each service:
   - `frontend/Dockerfile` - Nginx with static files
   - `backend/Dockerfile` - PHP-FPM with Apache
   - Database: Use official MySQL image
2. Create `docker-compose.yml` for local development
3. Build Docker images with unique tags:
   - `25rp20201-mbarushimana/patient-frontend:v1.0`
   - `25rp20201-mbarushimana/patient-backend:v1.0`
4. Push images to Docker Hub
5. Test multi-container setup locally

**Docker Compose Services:**
```yaml
- frontend (port 80)
- backend (port 8080)
- mysql (port 3306)
```

**Deliverables:**
- All Dockerfile configurations
- docker-compose.yml file
- Screenshots of running containers (`docker ps`)
- Docker Hub repository screenshots
- Container logs

---

### **PHASE 6: Orchestration (Kubernetes)**
**Objective:** Deploy application to Kubernetes cluster

**Tools:** kubectl, Kubernetes (Docker Desktop)

**Tasks:**
1. Create Kubernetes namespace: `25rp20201-mbarushimana`
2. Create YAML manifests:
   - **Deployments:**
     - `k8s/frontend-deployment.yml`
     - `k8s/backend-deployment.yml`
     - `k8s/mysql-deployment.yml`
   - **Services:**
     - `k8s/frontend-service.yml` (LoadBalancer)
     - `k8s/backend-service.yml` (ClusterIP)
     - `k8s/mysql-service.yml` (ClusterIP)
   - **ConfigMaps & Secrets:**
     - `k8s/mysql-configmap.yml` (database config)
     - `k8s/mysql-secret.yml` (passwords)
   - **PersistentVolume:**
     - `k8s/mysql-pvc.yml` (data persistence)
3. Deploy to Kubernetes cluster
4. Verify all pods are running
5. Access application via LoadBalancer

**Deployment Strategy:**
- Rolling updates
- Replica sets (2 replicas for backend/frontend)
- Health checks (liveness & readiness probes)

**Deliverables:**
- All Kubernetes YAML manifests
- Screenshots of deployed resources (`kubectl get all -n 25rp20201-mbarushimana`)
- Pod logs
- Application access screenshots
- Architecture diagram

---

### **PHASE 7: Automation (CI/CD Pipeline)**
**Objective:** Automate the complete deployment pipeline

**Tools:** GitHub Actions

**Tasks:**
1. Extend CI pipeline to include CD
2. Create `.github/workflows/cd.yml`:
   - Build Docker images on merge to main
   - Push to Docker Hub with version tags
   - Deploy to Kubernetes automatically
   - Run smoke tests (basic health checks)
3. Set up GitHub Secrets:
   - `DOCKER_USERNAME`
   - `DOCKER_PASSWORD`
   - `KUBECONFIG` (if deploying remotely)
4. Configure automatic deployment on merge to `main`
5. Document rollback procedures

**CD Pipeline Flow:**
```
Code Push → Build → Test → Containerize → Push to Registry → Deploy to K8s → Verify
```

**Deliverables:**
- Complete CI/CD workflow files
- Pipeline execution screenshots
- Deployment logs
- Rollback procedure documentation

---

### **PHASE 8: Configuration Management**
**Objective:** Manage configurations across environments

**Tools:** ConfigMaps, Secrets, Environment Variables

**Tasks:**
1. Externalize all configurations:
   - Database credentials
   - API URLs
   - Application settings
2. Create environment-specific configs:
   - Development
   - Production
3. Use Kubernetes ConfigMaps for non-sensitive data
4. Use Kubernetes Secrets for sensitive data (base64 encoded)
5. Document configuration management strategy

**Configuration Items:**
- Database host, port, name
- Database username/password
- API base URL
- CORS settings
- Application port

**Deliverables:**
- ConfigMap and Secret YAML files
- Configuration management documentation
- Environment comparison table
- Screenshots of applied configs

---

### **PHASE 9: Monitoring & Logging**
**Objective:** Implement monitoring and logging solutions

**Tools:** Kubernetes Dashboard, kubectl logs, Docker logs

**Tasks:**
1. Set up Kubernetes Dashboard (optional but recommended)
2. Configure resource monitoring:
   - CPU usage per pod
   - Memory usage per pod
   - Pod health status
3. Implement centralized logging:
   - Application logs
   - Container logs
   - Error tracking
4. Create custom monitoring dashboard: `25rp20201-mbarushimana-dashboard`
5. Set up basic alerts (manual monitoring checks)
6. Document troubleshooting procedures

**Monitoring Metrics:**
- Pod status and restarts
- Resource utilization
- API response times (basic)
- Error rates
- Active connections

**Deliverables:**
- Kubernetes Dashboard screenshots
- Monitoring dashboard screenshots
- Log collection examples
- Resource usage graphs
- Troubleshooting guide

---

### **PHASE 10: Reliability & Best Practices**
**Objective:** Implement DevOps best practices for reliability

**Tasks:**
1. **High Availability:**
   - Multiple replicas (min 2 per service)
   - Load balancing configuration
2. **Health Checks:**
   - Liveness probes (check if container is alive)
   - Readiness probes (check if ready to serve traffic)
3. **Resource Management:**
   - CPU/Memory requests and limits
4. **Security:**
   - Non-root containers
   - Secret management
   - Read-only root filesystem (where possible)
5. **Backup & Recovery:**
   - Database backup strategy
   - Disaster recovery plan
   - Volume snapshots
6. **Documentation:**
   - Complete architecture diagram
   - Deployment runbook
   - Rollback procedures
   - Incident response plan

**Best Practices Implemented:**
- ✅ Infrastructure as Code (all YAML manifests)
- ✅ Automated CI/CD
- ✅ Container security
- ✅ Resource limits
- ✅ Health monitoring
- ✅ Persistent storage
- ✅ Configuration management

**Deliverables:**
- Updated Kubernetes manifests with best practices
- Security checklist
- Backup/restore scripts or procedures
- Complete architecture diagram
- DevOps runbook

---

## 📁 Complete Project Structure
```
25rp20201_mbarushimana-patient-management/
├── frontend/
│   ├── index.html
│   ├── app.js
│   └── Dockerfile
├── backend/
│   ├── index.php
│   ├── api/
│   │   └── patients.php
│   ├── config/
│   │   └── database.php
│   ├── models/
│   │   └── Patient.php
│   ├── composer.json
│   └── Dockerfile
├── k8s/
│   ├── namespace.yml
│   ├── frontend-deployment.yml
│   ├── frontend-service.yml
│   ├── backend-deployment.yml
│   ├── backend-service.yml
│   ├── mysql-deployment.yml
│   ├── mysql-service.yml
│   ├── mysql-pvc.yml
│   ├── mysql-configmap.yml
│   └── mysql-secret.yml
├── .github/
│   └── workflows/
│       ├── ci.yml
│       └── cd.yml
├── docker-compose.yml
├── README.md
├── .gitignore
└── docs/
    ├── architecture-diagram.png
    └── deployment-guide.md
```
