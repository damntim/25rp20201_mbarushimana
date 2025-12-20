# DevOps Patient Management

[Replace `<OWNER>` with your GitHub username]
![CI Status](https://github.com/damntim/25rp20201_mbarushimana/actions/workflows/ci.yml/badge.svg)

## Table of Contents
- [Overview](#overview)
- [Architecture](#architecture)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Usage](#usage)
- [API Documentation](#api-documentation)
- [CI Pipeline](#ci-pipeline)
- [Docker](#docker)
- [Kubernetes Deployment](#kubernetes-deployment)
- [Monitoring & Troubleshooting](#monitoring--troubleshooting)
- [Screenshots](#screenshots)
- [References](#references)

## Overview
Patient Management application implementing a full DevOps lifecycle:
- Version control and Git workflow
- PHP application with simple API endpoints
- CI pipeline with GitHub Actions
- Docker containerization and registry publishing
- Kubernetes deployment and monitoring

## Architecture
High-level components:
- Web (PHP, Apache) serving index.php and api.php
- Storage via JSON file at `data/patients.json`
- CI builds + linting; Docker image published to Docker Hub
- Kubernetes deployment with liveness/readiness probes
See detailed description in `docs/architecture.md`. Add your diagram at `docs/architecture.png`.

## Prerequisites
- Git, GitHub account and repository
- PHP 8.1 and Composer (if dependencies are used)
- Docker (Desktop)
- Docker Hub account and repository
- Kubernetes cluster with `kubectl` configured
- Access to create GitHub Actions secrets: `DOCKERHUB_USERNAME`, `DOCKERHUB_TOKEN`

## Installation
Clone repository:
```bash
git clone https://github.com/damntim/25rp20201_mbarushimana.git
```