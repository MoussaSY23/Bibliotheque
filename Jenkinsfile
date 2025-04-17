pipeline {
    agent {
        docker {
            image 'php:8.2-cli'
        }
    }

    environment {
        APP_ENV = 'local'
        COMPOSER_HOME = '/var/jenkins_home/.composer' // Répertoire de cache de Composer
        COMPOSER_PATH = '/var/jenkins_home/composer.phar' // Emplacement du fichier Composer
    }

    stages {
        stage('Installer Composer') {
            steps {
                sh 'php -r "copy(\'https://getcomposer.org/installer\', \'composer-setup.php\');"'
                sh 'php composer-setup.php'
                sh 'mv composer.phar $COMPOSER_PATH'
                sh 'php $COMPOSER_PATH --version'
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
                sh 'php $COMPOSER_PATH install --no-interaction --prefer-dist --optimize-autoloader'
                sh 'cp .env.example .env'
                sh 'php artisan key:generate'
            }
        }

        stage('Construire image Docker') {
            steps {
                sh 'docker build -t moussasy23/librairie:latest .'
            }
        }
    }
}
