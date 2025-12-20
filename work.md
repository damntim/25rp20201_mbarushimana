# DevOps Complete Workflow Guide
**Project:** Patient Management System  
**DevOps Identifier:** `25rp20201_mbarushimana`  
**Student:** 25rp20201 - Mbarushimana  
**Environment:** WSL, Docker Desktop, Kubernetes, GitHub

---

## 🎯 Project Overview
A simple Patient Management System demonstrating the complete DevOps lifecycle. The application allows adding and retrieving patient information through a web interface.

**Application Stack:**
- **Application:** PHP (Single stack with HTML/CSS/JavaScript frontend)
- **Database:** JSON file storage
- **Architecture:** Monolithic application (Single container)

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
5. Verify installations with version checks

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
       ├── feature/patient-api
       └── feature/json-storage
```

**Deliverables:**
- Repository URL
- Screenshots of Git workflow
- Commit history
- Branch structure diagram

---

### **PHASE 3: Application Development** 
**Objective:** Develop the Patient Management System
**Status:** Completed ✅

<!-- The following sub-sections remain as documented -->
**Components:**

#### **3.1 PHP Application (Single Stack)**
**Files:**
- `index.php` - Main entry point with HTML form and display
- `api.php` - API endpoints handler
- `Patient.php` - Patient model class
- `data/patients.json` - JSON database file
- `composer.json` - Dependencies (if needed)
- `config.php` - Application configuration

**API Endpoints:**
- `POST /api.php?action=add` - Add new patient
- `GET /api.php?action=list` - Get all patients
- `GET /api.php?action=get&id=X` - Get patient by ID

#### **3.2 Frontend (Embedded in PHP)**
**Features:**
- HTML form to add patient (Name, Age, Email, Condition)
- Display list of patients in cards
- Responsive design with Tailwind CSS CDN
- Modern UI with gradient backgrounds
- JavaScript for form handling and dynamic updates

#### **3.3 Database (JSON)**
**Structure:**
```json
{
  "patients": [
    {
      "id": "1",
      "name": "John Doe",
      "age": 30,
      "email": "john@example.com",
      "condition": "Flu",
      "created_at": "2024-01-01 10:00:00"
    }
  ]
}
```

**Deliverables:**
- Source code for all components (index.php, api.php, Patient.php, config.php, composer.json, data/patients.json)
- Local testing screenshots
- API testing with Postman/curl
- Sample JSON database file

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
   - Build Docker image
   - Push image to Docker Hub
3. Add status badges to README

**CI Pipeline Steps:**
```yaml
Build → Test → Lint → Docker Build → Push to Registry
```

**Deliverables:**
- GitHub Actions workflow file
- CI pipeline run screenshots
- Test results
- Docker Hub repository link

---

### **PHASE 5: Containerization (Docker)**
**Objective:** Package application into Docker container

**Tools:** Docker, Docker Compose, Docker Hub

**Tasks:**
1. Create Dockerfile for the application:
   - `Dockerfile` - PHP with Apache
   - Include JSON data directory with proper permissions
2. Create `docker-compose.yml` for local development
3. Build Docker image with unique tag:
   - `25rp20201-mbarushimana/patient-management:v1.0`
4. Push image to Docker Hub
5. Test container locally with volume mount for data persistence

**Docker Configuration:**
```yaml
- app (port 80)
  - Volume mount for data/patients.json
```

**Deliverables:**
- Dockerfile configuration
- docker-compose.yml file
- Screenshots of running container (`docker ps`)
- Docker Hub repository screenshot
- Container logs

---

### **PHASE 6: Orchestration (Kubernetes)**
**Objective:** Deploy application to Kubernetes cluster

**Tools:** kubectl, Kubernetes (Docker Desktop)

**Tasks:**
1. Create Kubernetes namespace: `25rp20201-mbarushimana`
2. Create YAML manifests:
   - **Deployment:**
     - `k8s/app-deployment.yml`
   - **Service:**
     - `k8s/app-service.yml` (LoadBalancer)
   - **ConfigMap:**
     - `k8s/app-configmap.yml` (application config)
   - **PersistentVolume:**
     - `k8s/app-pvc.yml` (JSON data persistence)
3. Deploy to Kubernetes cluster
4. Verify all pods are running
5. Access application via LoadBalancer

**Deployment Strategy:**
- Rolling updates
- Replica sets (2 replicas for high availability)
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
   - Build Docker image on merge to main
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

**Tools:** ConfigMaps, Environment Variables

**Tasks:**
1. Externalize all configurations:
   - JSON file path
   - API URLs
   - Application settings
2. Create environment-specific configs:
   - Development
   - Production
3. Use Kubernetes ConfigMaps for configuration data
4. Document configuration management strategy

**Configuration Items:**
- JSON database file path
- Application base URL
- File permissions
- Application port

**Deliverables:**
- ConfigMap YAML files
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
- JSON file read/write operations

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
   - Shared volume for JSON data across replicas
2. **Health Checks:**
   - Liveness probes (check if container is alive)
   - Readiness probes (check if ready to serve traffic)
3. **Resource Management:**
   - CPU/Memory requests and limits
4. **Security:**
   - Non-root containers
   - Read-only root filesystem (except data directory)
   - Proper file permissions for JSON database
5. **Backup & Recovery:**
   - JSON file backup strategy
   - Disaster recovery plan
   - Volume snapshots
6. **Documentation:**
   - Complete architecture diagram
   - Deployment runbook
   - Rollback procedures
   - Incident response plan

---

## 📁 Complete Project Structure
```
25rp20201_mbarushimana-patient-management/
├── index.php
├── api.php
├── Patient.php
├── config.php
├── composer.json
├── data/
│   └── patients.json
├── Dockerfile
├── k8s/
│   ├── namespace.yml
│   ├── app-deployment.yml
│   ├── app-service.yml
│   ├── app-pvc.yml
│   └── app-configmap.yml
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

---

## 🔄 Key Changes from Multi-Service Architecture
1. **Single Container**: One Docker image contains the entire PHP application
2. **JSON Database**: No separate database container - data stored in JSON file
3. **Volume Management**: PersistentVolume for JSON file ensures data persistence across pod restarts
4. **Simplified Deployment**: Single deployment manifest instead of multiple services
5. **Shared Storage**: Multiple replicas share the same JSON file via PersistentVolume