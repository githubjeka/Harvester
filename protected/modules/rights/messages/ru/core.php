<?php
/**
 * Message translations.
 *
 * This file is automatically generated by 'yiic message' command.
 * It contains the localizable messages extracted from source code.
 * You may modify this file by translating the extracted messages.
 *
 * Each array element represents the translation (value) of a message (key).
 * If the value is empty, the message is considered as not translated.
 *
 * NOTE, this file must be saved in UTF-8 encoding.
 *
 * @version $Id: $
 */
return array (
  'A descriptive name for this item.' => 'Название элемента, которое будет отображаться в списке',
  'A role is group of permissions to perform a variety of tasks and operations, for example the authenticated user.' => 'Роль - набор разрешений для выполнения набора Заданий и Операций. Например, "Зарегистрированный пользователь".',
  'A task is a permission to perform multiple operations, for example accessing a group of controller action.' => 'Задание - разрешение на выполнение нескольких Операций. Например, доступ к нескольким дейтсвиям контроллера.',
  'Additional data available when executing the business rule.' => 'Дополнительные данные, доступные во время выполнения бизнес-правила.',
  'An operation is a permission to perform a single operation, for example accessing a certain controller action.' => 'Операция - разрешения на выполнение отдельного действия.',
  'Are you sure you want to delete this operation?' => 'Вы точно хотите удалить эту операцию?',
  'Are you sure you want to delete this role?' => 'Вы точно хотите удалить эту роль?',
  'Are you sure you want to delete this task?' => 'Вы точно хотите удалить это задание?',
  'Assign item' => 'Назначить элемент',
  'Authorization item' => 'Элемент авторизации',
  'Authorization items can be managed under {roleLink}, {taskLink} and {operationLink}.' => 'Элементы авторизации могут быть изменены в разделах {roleLink}, {taskLink} и {operationLink}.',
  'Business rule cannot be empty.' => 'Базнес-правило не может быть пустым',
  'Cancel' => 'Отмена',
  'Code that will be executed when performing access checking.' => 'Код, который будет выполнен при проверке доступа.',
  'Do not change the name unless you know what you are doing.' => 'Пожалуйста, меняйте имя только если точно знаете, что делаете!',
  'Generate items' => 'Сгенерировать элементы',
  'Generate items for controller actions' => 'Сгенерировать элементы авторизации для действий контроллеров',
  'Here you can view and manage the permissions assigned to each role.' => 'Здесь вы можете управлять разрешениями, назначенными ролям.',
  'Here you can view which permissions has been assigned to each user.' => 'Здесь вы можете видеть, какие права назначены пользователям',
  'Item' => 'Элемент',
  'Name of the superuser cannot be changed.' => 'Имя роли суперпользователя не может быть изменено',
  'No actions found.' => 'Действия не найдены',
  'No assignments available to be assigned to this user.' => 'Нет прав для назначения этому пользователю.',
  'No children available to be added to this item.' => 'Нет элементов для добавления в качестве потомков.',
  'Operations exist below tasks in the authorization hierarchy and can therefore only inherit from other operations.' => 'Операции находятся ниже заданий в иерархии авторизации, потому могут быть унаследованы только от других операций.',
  'Permission :name assigned.' => 'Разрешение :name назначено.',
  'Permission :name revoked.' => 'Разрешение :name отозвано',
  'Please select which items you wish to generate.' => 'Подалуйста, выберите элементы, которые вы хотите сгенерировать.',
  'Roles exist at the top of the authorization hierarchy and can therefore inherit from other roles, tasks and/or operations.' => 'Роли находятся на вершине иерархии авторизации, потому могут быть унаследованы от других ролей, заданий и/или операций.',
  'Rights' => 'Права пользователей',
  'Source' => 'Источник',
  'Tasks exist below roles in the authorization hierarchy and can therefore only inherit from other tasks and/or operations.' => 'Задания находятся ниже ролей в иерархии авторизации, потому они могут быть унаследованы только от других заданий и/или операций',
  'There must be at least one superuser!' => 'Должен быть как минимум один суперпользователь',
  'This user has not been assigned any items.' => 'Этому пользователю не назвачено ни одного элемента авторизации.',
  'Type' => 'Тип',
  'Update :name' => 'Изменить :name',
  ':name created.' => ':name создано.',
  ':name deleted.' => ':name удалено.',
  ':name updated.' => ':name изменено.',
  'Add' => 'Добавить',
  'Add Child' => 'Добавить потомка',
  'An item with this name already exists.' => 'Элемент с таким названием уже существует.',
  'Application' => 'Приложение',
  'Assign' => 'Запрещено',
  'Assignments' => 'Права',	// TODO: проверить, нигде ли больше не упоминается это слово, кроме списка юзеров
  'Assignments for :username' => 'Права для :username',
  'Authorization items created.' => 'Элемент авторизации создан.',
  'Business rule' => 'Бизнес-правило',
  'Child :name added.' => 'Потомок :name добавлен.',
  'Child :name removed.' => 'Потомок :name удален.',
  'Children' => 'Потомки',
  'Create :type' => 'Создать :type',
  'Create a new operation' => 'Создать операцию',
  'Create a new role' => 'Создать роль',
  'Create a new task' => 'Создать задание',
  'Data' => 'Данные',
  'Delete' => 'Удалить',
  'Description' => 'Описание',
  'Generate' => 'Сгенерировать',
  'Hover to see from where the permission is inherited.' => 'Наведите курсор мыши, чтоб увидеть, откуда унаследован элемент.',
  'Inherited' => 'Унаследовано',
  'Invalid authorization item type.' => 'Неправильный тип элемента авторизации.',
  'Invalid request. Please do not repeat this request again.' => 'Неправильный запрос. Пожалуйста, не повторяйте его снова.',
  'Modules' => 'Модуль',
  'Name' => 'Имя',
  'No authorization items found.' => 'Элементы авторизации не найдены.',
  'No operations found.' => 'Операции не найдены.',
  'No relations need to be set for the superuser role.' => 'Нет необходимости создавать отношения для суперпользователя.',
  'No roles found.' => 'Роли не найдены.',
  'No tasks found.' => 'Задания не найдены.',
  'No users found.' => 'Пользователи не найдены.',
  'Operation' => 'Операция',
  'Operations' => 'Операции',
  'Parents' => 'Родители',
  'Permissions' => 'Разрешения',
  'Relations' => 'Отношения',
  'Remove' => 'Удалить',
  'Revoke' => 'Разрешено',
  'Role' => 'Роль',
  'Roles' => 'Роли',
  'Save' => 'Сохранить',
  'Select all' => 'Выделить все',
  'Select none' => 'Убрать выделение',
  'Super users are always granted access implicitly.' => 'Суперпользователи всегда обладают всеми правами.',
  'Task' => 'Задание',
  'Tasks' => 'Задания',
  'The requested page does not exist.' => 'Запрошенная страница не существует.',
  'This item has no children.' => 'У этого элемента нет потомков.',
  'This item has no parents.' => 'У этого элемента нет родителей.',
  'Values within square brackets tell how many children each item has.' => 'Значения в квадратных скобках показывают количество потомков.',
  'You are not authorized to perform this action.' => 'У вас недостаточно прав для выполнения данного действия.',
  'Rights' => 'Права пользователей',	
);
