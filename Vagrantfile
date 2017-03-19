# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

    config.vm.box = "scotch/box"
    config.vm.network "private_network", ip: "192.168.22.22"
    config.vm.hostname = "blog"
    config.vm.synced_folder ".", "/var/www", :mount_options => ["dmode=777", "fmode=666"]
    
    # Optional NFS. Make sure to remove other synced_folder line too
    #config.vm.synced_folder ".", "/var/www", :nfs => { :mount_options => ["dmode=777","fmode=666"] }

    config.vm.provision "shell", inline: <<-SHELL
        cd /var/www
        composer self-update
        composer create-project symfony/framework-standard-edition symfony-box "3.2.*"
        mv symfony-box/* .
        mv symfony-box/.gitignore .
        rm -rf symfony-box
        printf "\n/*.md\n/LICENSE\n/composer.json\n/.vagrant\n" >> .gitignore
        git init
        sudo sed -i s,/var/www/public,/var/www/web,g /etc/apache2/sites-available/000-default.conf
        sudo sed -i s,/var/www/public,/var/www/web,g /etc/apache2/sites-available/scotchbox.local.conf
        sudo service apache2 restart
    SHELL
end
