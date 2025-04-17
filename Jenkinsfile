pipeline {
    agent {
        dockerfile {
            filename 'Dockerfile'
            dir '.'
            // Monte le socket Docker de l'hôte pour que Jenkins puisse accéder à Docker
            args '-v /var/run/docker.sock:/var/run/docker.sock'
        }
    }

    environment {
        APP_ENV = 'local'
        COMPOSER_HOME = '/var/jenkins_home/.composer'
    }

    stages {
        stage('Installer Composer') {
            steps {
                sh '''
                    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
                    php composer-setup.php
                    mv composer.phar /var/jenkins_home/composer.phar
                    php /var/jenkins_home/composer.phar --version
                '''
            }
        }

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
                    php /var/jenkins_home/composer.phar install --no-interaction --prefer-dist --optimize-autoloader
                    cp .env.example .env
                    php artisan key:generate
                '''
            }
        }

        stage('Construire image Docker') {
            steps {
                // Construire l'image Docker avec Docker de l'hôte
                sh '''
                    docker --version
                    docker build -t MoussaSY23/librairie:latest .
                '''
            }
        }
    }
}
