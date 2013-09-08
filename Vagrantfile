# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  # Every Vagrant virtual environment requires a box to build off of.
  config.vm.box = "vemp"
  config.vm.box_url = "https://dl.dropbox.com/u/2382631/vemp.box"

  #config.ssh.max_tries = 10

  # Share an additional folder to the guest VM. The first argument is
  # the path on the host to the actual folder. The second argument is
  # the path on the guest to mount the folder. And the optional third
  # argument is a set of non-required options.
  config.vm.synced_folder "./www/", "/www/", :id => "vagrant-root", :owner => "vagrant", :group => "www-data", :extra => "dmode=755,fmode=644"
  config.vm.synced_folder "./shared/", "/shared/", :extra => "dmode=755,fmode=644"
  config.vm.synced_folder "./opt/", "/opt-external/", owner: "root", group: "root"

  # Create a public network, which generally matched to bridged network.
  # Bridged networks make the machine appear as another physical device on
  # your network.
  config.vm.network :public_network

  # Provider-specific configuration so you can fine-tune various
  # backing providers for Vagrant. These expose provider-specific options.
  # VirtualBox:
  config.vm.provider :virtualbox do |vb|
    	# Don't boot with headless mode
    	vb.gui = true
	# Use VBoxManage to customize the VM. For example to change memory:
	vb.customize ["modifyvm", :id, "--name", "vemp", "--memory", "4096", "--cpus", 2, "--cpuexecutioncap", "80"]
  end
end
