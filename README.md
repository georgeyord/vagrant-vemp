# Vemp Box

## Installation

1. Install [VirtualBox](https://www.virtualbox.org/wiki/Downloads) for your platform.
1. Install the latest version of [Vagrant](http://downloads.vagrantup.com/) for your platform (tested with 1.2.4)
1. Clone `git clone https://bitbucket.org/wwforce/vemp-vagrant.git`

In the repository checkout directory, run:

    $> vagrant box add vemp ./vemp.box
    $> vagrant up
    
Doing this the first time will take a few minutes as the operating system and all the required packages will be downloaded and installed.

*Subsequent runs will be much quicker!*

## Intialisation

1. Check nginx configuration is loaded correctly
    $> sudo nginx -t
1. Restart nginx to take the confguration laoded from shared folder
    $> sudo service nginx restart

1. Get VM's IP
    $> ifconfig | grep "inet addr" | grep Bcast
1. Open Browser and check the IP you got above returns a page
1. Get hosts record from above page and add it to host's /etc/hosts file
1. Open Browser and check any of the domain names from above
1. Done!

## Running

To start the virtual machine with Stash pre-installed and configured to run on [http://localhost:7000](http://localhost:7000) use:

    $> vagrant up

To SSH into the box use:

    $> vagrant ssh

To shutdown the virtual machine use:

    $> vagrant halt

To suspend the virtual machine use:

    $> vagrant suspend

To start from scratch (wiping the image) use `destroy`. A subsequent `vagrant up` will re-download the packages and Stash but it won't have to download the operation system again:

    $> vagrant destroy


## Credentials
- Command line & SSH Login : vagrant/vagrant 
- MySql : root/qwerty1 

## Features
- php-fpm
- nginx
- mysql
- phpmyadmin (phpmyadmin.ubs.com)
- java-jdk
- maven
- mahout ($MAHOUT_HOME/bin/mahout)
- ruby rvm
- memcached
- mongo
- n4j (on demand)
- solr (on demand)
- elasticsearch (on demand)

See for more information
- [http://docs.vagrantup.com/v2/](http://docs.vagrantup.com/v2/)
- [https://github.com/seanherron/vemp](VEMP idea)