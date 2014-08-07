# Vemp Box
**Vagrant - (e)Nginx - MySQL - PHP**

## Why use VEMP?
If you want to see your web projects run locally without worrying about the configuration details of the webwerver then VEMP is here for you.
Start a virtual machine which can handle all your projects and manage all files and configurations without even logging in the guest machine.

## Installation

1. Install [VirtualBox](https://www.virtualbox.org/wiki/Downloads) for your platform.
1. Install the latest version of [Vagrant](http://downloads.vagrantup.com/) for your platform
1. Create the directory of the project `mkdir vemp`
1. `cd vemp`
1. Init git `git init`
1. Add repository `git remote add upstream git@bitbucket.org:wwforce/vemp-vagrant.git`
1. Fetch all branches `git fetch upstream`
1. Check out master branch: checkout upstream/master -b master`

In the repository directory, initialze the vagrant box. Run:

    > cd vagrant
    > vagrant up

*Doing this the first time will take a few minutes as the operating system and all the required packages will be downloaded and installed. Subsequent runs will be really quicker, promise!*

### Reasons to fail and solutions

#### Vagrant box exists but still you want to replace it with a different box
Run the following command BEFORE the commands above:

    > vagrant box remove vemp virtualbox

#### Virtuabox returns error of type VERR_ALREADY_EXISTS

You already have a VM named "vemp". You can either change the name of the new machine to something else (or nothing at all ;-) ) or remove the previous VM from virtualbox application. For 1st option open Vagrantfile and edit `"--name", "vemp",` in the following line

`vb.customize ["modifyvm", :id, "--name", "vemp", "--memory", "4096", "--cpus", 2, "--cpuexecutioncap", "80"]`

Change `"vemp"` to another name or remove both  `"--name"` and `"vemp"`

#### Vagrant up fails after "Mounting shared folders"

If Host is a linux machine, make sure that `nfs-kernel-server` is installed and running. In Ubuntu:

    > sudo apt-get install nfs-kernel-server

#### Vagrant up fails STILL after "Mounting shared folders"

Check that VirtualBox Guest Additions is correctly installed and active in host (solution taken from [here](http://docs-v1.vagrantup.com/v1/docs/troubleshooting.html))

* Connect to the guest `vagrant ssh`
* Run `lsmod | grep vboxsf`
    * If that command does not return any output, it means that the VirtualBox Guest Additions are not loaded.
    * If the VirtualBox Guest Additions were previously installed on the machine, you will more than likely be able to rebuild them for the new kernel through the vboxadd initscript, in Ubuntu `sudo /etc/init.d/vboxadd setup`
    * If the VirtualBox Guest Additions are missing use this [guide](http://software.darrenthetiger.com/2012/01/installing-virtualbox-guest-additions-on-a-vagrant-lucid64-box) to install them

## Intialization

1. Host: (optional) Copy id_rsa and id_rsa.pub in vagrant/ssh to use them in Guest
1. Host: Run `cd vagrant/etc/ & cp hosts-example hosts & cd ../..` to copy/activate the basic hosts file
1. Host: `vagrant ssh` to SSH into Guest
1. Guest: Check nginx configuration is loaded correctly `sudo nginx -t`
1. Guest: Run `~/bin/myservice res~/bin/myservices restartmv pa` to start all the services that depend on external folders
1. Guest: Get VM's internal IP `~/bin/myip`
1. Host: Open Browser and check the IP you got above returns a page
1. Host: Get hosts record from above page and add it to host's /etc/hosts file
1. Host: Open Browser and check any of the domain names from above
1. Done!

## Running

To start the virtual machine use `--provision` (it is used to start the servies needed after mounting shared folders):

    > vagrant up --provision

or use the sh file included:

    > ./vempup

A message like the following will be at the end of the script:
    
    > Your internal IP Address is:
    > [IP]
    > Your external IP Address is:
    > [IP]

If you think something went wrong, check vemp.log located at `var/log/vemp.log` or SSH into the box using:

    > vagrant ssh

And try to restart all services
    > ~/bin/serviceStart

To shutdown the virtual machine use:

    > vagrant halt

To suspend the virtual machine use:

    > vagrant suspend

To start from scratch (wiping the image) use `destroy`. A subsequent `vagrant up` will re-download the packages and stash but it won't have to download the operation system again:

    > vagrant destroy

If you don't feel confident that you can open the VirtualBox GUI to see the loading process. To do it uncomment the line `# vb.gui = true` to `vb.gui = true` in Vagrantfile.

## Add your project
1. Create a folder in `shared/www` and add all your project files
1. Create a vhost configuration file in `vagrant/etc/nginx/sites-available`
1. Add you vhost name in `vagrant/etc/hosts`
1. Done!
*Check out how the existing sites are built using partial configuration files located in `vagrant/etc/nginx/conf/`, they may help you build your own conf file*

## Folder structure inside "shared" folder
* Host **www** Guest /var/www Location of web projects
* Host **mysql** Guest /shared/mysql/ Location of MySql databases

## Folder structure inside "vagrant" folder
* Host **etc/hosts** Guest '/etc/hosts' (through link poinitng to `/vagrant/etc/hosts`)
* Host **etc/nginx/sites-available** Guest '/etc/nginx/sites-available' (through link poinitng to `/vagrant/etc/nginx/sites-available`)
* Host **var/log/nginx** Guest '/var/log/nginx'
* Host **bin** Guest '/home/vagrant/bin' SH script to run using `~/bin/[script]`
* Host **ssh** Guest '/home/vagrant/ssh' SSH keys to use in Guest

## Folders structure in guest machine that point to shared folders from host
* **/etc/hosts** point to /vagrant/etc/hosts
* **/etc/nginx/sites-available** point to /vagrant/etc/nginx/sites-available
* **/etc/nginx/sites-enable** point to /vagrant/etc/nginx/sites-available
* **/etc/nginx/conf** point to /vagrant/etc/nginx/conf
* **/var/log/nginx**  point to /vagrant/var/log/nginx

## Logs in guest machine
* **/vagrant/var/log/vemp.log** (edit Vagrantfile to change)
* **/vagrant/var/log/nginx/access.log** (edit vhost files in `/etc/nginx/sites-available` to change per vhost)
* **/vagrant/var/log/nginx/error.log**
* **/vagrant/var/log/xdebug.log** (edit `/etc/php5/fpm/conf.d/20-xdebug.ini` to change)
* **/vagrant/var/log/php5-fpm.log** (edit `/etc/php5/fpm/php-fpm.conf` to change)
* **/var/log/mysql/error.log** (edit `/etc/mysql/my.cnf` to change)
* **/home/vagrant/clarity.log**

## Credentials
- Command line & SSH Login : vagrant/vagrant
- MySql : root/qwerty1

## Features
- php-fpm
- nginx
- mysql
- phpmyadmin (phpmyadmin.ubs.com)
- phpunit
- php x-debug
- java-jdk
- maven
- mahout ($MAHOUT_HOME/bin/mahout)
- ruby rvm
- memcached
- mongo
- clarity (on demand)
- n4j (on demand)
- solr (on demand)
- elasticsearch (on demand)


## RAW notes for Windows users
- At first you need to install
-- Git for Windows
-- Gitshell
-- VirtualBox
-- Vagrant
-- Reference: http://www.habdas.org/developing-modern-web-applications-on-windows-vagrant/
- Symlinks dont work for VirtualBox versions after 4.1.6, to fix this, run VirtualBox UI and vagrant as Administrator
-- Reference: https://www.virtualbox.org/ticket/10085 (`VBoxManage.exe setextradata vemp VBoxInternal2/SharedFoldersEnableSymlinksCreate/SHARE_NAME 1`)
- To use different ssh keys use in Gitshell `ssh-add path/to/key`
-- Notice: these keys will be public for all windows users

See for more information

- [https://www.virtualbox.org/](https://www.virtualbox.org/)
- [http://docs.vagrantup.com/v2/](http://docs.vagrantup.com/v2/)https://www.virtualbox.org/ 
- [Vagrant on windows](http://www.habdas.org/developing-modern-web-applications-on-windows-vagrant/)
- [VEMP idea](https://github.com/seanherron/vemp)