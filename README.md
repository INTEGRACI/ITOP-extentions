# README #

Это модуль расширения для iTop (Open Source ITSM http://www.combodo.com/).


### Зачем? ###

Модуль предназначен для управления конфигурационными единицами, полезными с точки зрения специалиста по информационной безопасности.
Новые классы КЕ и функции добавляются по мере разработки. Автор принимает пожелания от коллег по добавлению типов конфигурационных единиц специфичных для информационной безопасности.

Текущая версия 1.1.0 

Это версия 1.1.1  
Сейчас в стадии разработки. Ведутся минорные обновления версии 1.1.0. Некоторая оптимизация кода и корректировки презентаций данных.
 
### История версий ###
* Version 1.1.0.

Добавлено управление чек-листами. Это классы объектов "требование проверки", которые можно привязывать к элементам конфигурации и ставить отметки о выполненной проверке соответствия.
По смыслу эти объекты отражают, например, требования стандарта PCI DSS, или положения 382-П, которые должны быть отнесены к соответствующим элементам инфраструктуры или к самой организации.  
Подробнее в файле esguardian-security-mgmt/usage.md.

Изменено меню. Меню управления собрано в одной группе верхнего уровня "Управление элементами безопасности".

Изменены профили. Создано два профиля "Security Role Manager" и "Security Checklist Manager". 


* Version 1.0.1.

Изменена иерархия классов. Верхним классом для всех объектов является класс SecurityCI. В него перенесены атрибуты связи с документами, задачами, организацией и атрибут "manager_list", который по смыслу означает список людей уполномоченных утверждать/согласовывать изменения конфигурации объектов.
Класс SecurityRole теперь наследует атрибуты и методы класса SecurityCI.

Добавлен новый класс SecurityRoleTemplate. По смыслу это набор ролей, который можно приписать к человеку. Объекты этого класса можно использовать, если в организации роли детализированы слишком сильно и приходится приписывать человеку множество ролей. Шаблон это не то же самое, что "группа безопасности". Списки ролей различных шаблонов могут пересекаться. Если добавить человека в список "Применить к ..." шаблона, то этот человек будет назначен оккупантом всех ролей, включенных в шаблон. Если к человеку применить несколько шаблонов, будут назначены роли в совокупности. Если затем убрать человека из списка "Применить к ..." одного из шаблонов, у него будут "отняты" только те роли, которые не содержатся в других шаблонах. Аналогично, если изменить сам шаблон, добавив в него новую роль, она будет назначена всем людям, содержащимся в списке "применить к ..." этого шаблона. Если напротив удалить роль, она отменится по всему списку только у тех людей, которым та же самая роль не назначена применением другого шаблона. 
Непосредственное назначение ролей не учитывает шаблоны. Например, если человеку назначить роли с помощью шаблона, а затем "вручную" удалить какие-либо роли непосредственно на странице управления персоной, то повторное применение шаблонных ролей не произойдет. Желательно не смешивать ручное и шаблонное назначение ролей персонам.
В шаблоне поддерживается контроль конфликтов ролей, при включении в шаблон несовместимых ролей, они будут показаны на отдельной вкладке.


* Version 1.0.0.

Создан **базовый набор для управления ролями пользователей**. Базовый абстрактный класс SecurityRole и два финальных класса BusinessRole и Application Role, предназначенные для описания ролей в бизнес-процессах и прикладных решениях. На более низком уровне, по мнению автора, нет смысла описывать роли. Через абстрактный класс SecurityRole можно устанавливать связи ролей с документами, людьми (оккупанты ролей), задачами (всех типов, включая инциденты и запросы на изменения).
Поддерживается задание несовместимости ролей, как установка симметричной связи роль-роль. Также в классе Person добавлены закладки "Роли" и "Конфликты". На первой показываются оккупированные роли и можно добавить/удалить элементы, на последней показываются конфликты между оккупированными персоной ролями, если они имеются. В объектах типов "бизнес-процесс" и "Прикладное решение" также показываются списки относящихся к ним ролей и можно добавить/удалить роли.
Поддерживаются русский и английский интерфейсы


### Что нужно для установки ###

* Если вы не знаете как установить сам iTop, можете воспользоваться скриптом из сниппета https://bitbucket.org/snippets/esguardian/78Raa 
* Скопируйте папку esguardian-security-mgmt со всем содержимым в каталог itop/extensions на вашем веб-сервере iTop
* Установите права write на php файл конфигурации iTop (обычно /var/www/html/itop/conf/production/config-itop.php
* Запустите процесс апдейта iTop в веб-браузере (http://www.yourhost.dom/itop/setup)
* В шагах мастера установки выберите модуль Security Objects Configuration Management когда он появится. 
* Для управления ролями пользователю должен быть назначен профиль Role Manager (Добавляется в iTop после установки).

### Связаться с автором ###
* esguardian@outlook.com
* http://esguardian.ru
