# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
config.vm.box = "ubuntu/trusty64"
  config.vm.provision :shell, :path => "bootstrap.sh"
  config.vm.network :forwarded_port, host: 3010, guest: 80
  config.vm.network :forwarded_port, host: 8020, guest: 8015
  config.vm.network :forwarded_port, host: 3310, guest: 3306

  #config.vm.synced_folder ".", "/vagrant", type: "rsync", rsync__auto: true, rsync__exclude: [".git/"]
  config.vm.synced_folder ".", "/vagrant", type: "nfs"
  config.vm.network "private_network", ip: "10.0.1.60"

  config.vm.provider :virtualbox do |virtualbox|
    virtualbox.customize ["modifyvm", :id, "--cpus", "2"]
    virtualbox.customize ["modifyvm", :id, "--ioapic", "on"]
    # allocate max 90% CPU
    virtualbox.customize ["modifyvm", :id, "--cpuexecutioncap", "90"]
    virtualbox.customize ["modifyvm", :id, "--memory", "4048"]
  end

  config.vm.hostname = 'ws.dev'

  unless Vagrant.has_plugin?("HostManager")
    puts "--- SUGESTAO ---"
    puts "Que tal digitar no navegador 'templum.dev' ao invés de 'localhost:3000'?"
    puts "Instale o plugin hostmanager: 'vagrant plugin install vagrant-hostmanager'"
    puts "Visite https://github.com/smdahlen/vagrant-hostmanager para maiores informacoes"
    puts "----------------"
  end

  # configs for vagrant-hostmanager
  if Vagrant.has_plugin?("HostManager")
    config.hostmanager.enabled = true
    config.hostmanager.manage_host = true
    config.hostmanager.ignore_private_ip = false
    config.hostmanager.include_offline = true
    config.hostmanager.aliases = 'ws.dev'
    #config.vm.define 'example-box' do |node|
    #  node.vm.hostname = 'example-box-hostname'
    #  node.vm.network :private_network, ip: '192.168.42.42'
    #  node.hostmanager.aliases = %w(example-box.localdomain example-box-alias)
    #end
  end

  #if Vagrant.has_plugin?("Landrush")
  #  config.landrush.enabled = true
  #  config.landrush.tld = 'dev'
  #end
end
