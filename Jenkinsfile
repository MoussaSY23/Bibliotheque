pipeline {
    agent {
        dockerfile {
            filename 'Dockerfile'
            dir '.'
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
                sh 'docker build -t MoussaSY23/librairie:latest .'
            }
        }
    }
}
