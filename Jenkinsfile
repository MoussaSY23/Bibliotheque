pipeline {
    agent {
        dockerfile {
            filename 'Dockerfile'
            dir '.'
            // Ajouter volume pour Docker Socket et donner accès à l'exécutable Docker
            args '-v /var/run/docker.sock:/var/run/docker.sock -v /usr/bin/docker:/usr/bin/docker'
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
                // Ajout du chemin vers Docker pour éviter l'erreur "docker: not found"
                sh '''
                    export PATH=$PATH:/usr/bin
                    docker --version
                    docker build -t MoussaSY23/librairie:latest .
                '''
            }
        }
    }
}
