
Стенд разворачивается с помощью Vagrant, настройка выполняется с помощью ansible-playbook.
Две ВМ с nginx и балансировкой нагрузки round-robin, три ВМ с php-fpm, одна ВМ с СУБД PostgreSQL. На всех ВМ для упрощения выключен firewalld, selinux переведен в режим permissive.

##### Порядок запуска:
```
git clone <this repo>
vagrant up
ansible-playbook main.yml
```
#### Проверка;
Для проверки работы зайти браузером по адресу http://192.168.7.2
Зайти на nginx1 и убедиться, что адрес 192.168.7.2 принадлежит ей, после этого отключить сетевой интерфейс eth1.
Зайти на nginx2 и убедиться, что адрес был передан ВМ nginx2.




##### Комментарии:

| VIP адрес | IP адрес | Имя машины |
|-----------|-----------|--------------|
|192.168.7.2| 192.168.7.151 | nginx1 |
|192.168.7.2| 192.168.7.152 | nginx2 |
|-| 192.168.7.141 | backend1 |
|-| 192.168.7.142 | backend2 |
|-| 192.168.7.143 | backend3 |
|-| 192.168.7.161 | bdms01 |


