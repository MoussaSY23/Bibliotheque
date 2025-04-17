pipeline {
    agent {
        docker {
            image 'composer:2.6' // Utilise une image Docker avec PHP + Composer préinstallé
        }
    }

    environment {
        APP_ENV = 'local'
    }

    stages {
        stage('Cloner depuis GitHub') {
            steps {
                git(
                    url: 'https://github.com/MoussaSY23/librairie.git',
                    credentialsId: 'github-token',
                    branch: 'Sy_Moussa_librairie'
                )
            }
        }

        stage('Installer les dépendances Laravel') {
            steps {
                sh '''
                    composer install
                    cp .env.example .env
                    php artisan key:generate
                '''
            }
        }

        stage('Construire image Docker') {
            steps {
                sh 'docker build -t moussasy23/librairie:latest .'
            }
        }
    }
}
