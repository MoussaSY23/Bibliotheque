pipeline {
    agent any

    environment {
        APP_ENV = 'local'
    }

    stages {
        stage('Cloner depuis GitHub') {
            steps {
                git(
                    url: 'https://github.com/MoussaSY23/librairie.git',
                    credentialsId: 'github-token', // ← le même ID que tout à l'heure
                    branch: 'Sy_Moussa_librairie'
                )
            }
        }


        stage('Installer les dépendances Laravel') {
            steps {
                sh 'composer install'
                sh 'cp .env.example .env'
                sh 'php artisan key:generate'
            }
        }

        stage('Construire image Docker') {
            steps {
                sh 'docker build -t MoussaSY23/librairie:latest .'
            }
        }
    }
}
