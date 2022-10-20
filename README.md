Можете реализовать запросы через Postman

1.POST - {{url}}/api/auth/register
request body (form-data) {
   'name',email,password
}
return success
{
    "status": true,
    "message": "User Created Successfully",
    "token": "6|xsuXswgOH1gRsJP3znfhy0tHR9Pw4lGr5djFy9Lo"
}
return error
{
    "errors": {
        "email": [
            "The email field is required."
        ]
    }
    "status": 422
}

2.POST - {{url}}/api/auth/login
request body (form-data) {
   email,password
}

return success {
    "status": true,
    "message": "User Logged In Successfully",
    "token": "7|99luzfQlvUbGIU7snHhZxmgFLveA0UuBGHBvEIVv"
}
return error{
   cerdentials dont match or validation errors 
}

3.GET - {{url}}/api/tasks Таск лист

return {
"data": [
        {
            "id": 1,
            "name": "Task Name update",
            "deadline": "2022-10-22",
            "description": "it is description,it is description2222",
            "user_id": 2,
            "status": "Wait",
            "created_at": "2022-10-20T11:00:12.000000Z",
            "updated_at": "2022-10-20T11:35:14.000000Z"
        }
    ]
}

4.POST - {{url}}/api/tasks Добавить новый таск
request body (form-data) {
   name,deadline,description,user_id,status(необязателmный имеет значение по умолчанию (Pending) допустимые зрачение (Pending,Wait,Test,Ready)) 
}

return success{
 "data": {
        "name": "new Task",
        "deadline": "2022-10-22",
        "description": "it is description,it is description2222",
        "user_id": "2",
        "status": "Wait",
        "updated_at": "2022-10-20T12:09:07.000000Z",
        "created_at": "2022-10-20T12:09:07.000000Z",
        "id": 2
    }
}

return error{
validation errors
}

5.PUT - {{url}}/api/tasks/1 Редактировать очередной таск по id

request body (form-data) {
   name,deadline,description,user_id,status(необязателний имеет значение по умолчанию (Pending))
}

return success{
 "data": {
        "name": "new Task Updated",
        "deadline": "2022-10-22",
        "description": "it is description updated",
        "user_id": "2",
        "status": "Ready",
        "updated_at": "2022-10-20T12:09:07.000000Z",
        "created_at": "2022-10-20T12:09:07.000000Z",
        "id": 2
    }
}

return error{
validation errors or
Task Not found
}


5.DELETE - {{url}}/api/tasks/1 Удалить очередной таск по id

return success{
 Task Deleted Successfully
}

return error{
Task Not found
}


6.GET - {{url}}/api/users-tasks/{user} ({user} - id пользователя) таски очередного пользователя    

return success{
    "data": [
        {
            "id": 5,
            "name": "new Task Updateee",
            "deadline": "2022-10-22",
            "description": "it is description,it is description2222",
            "user_id": 2,
            "status": "Wait",
            "created_at": "2022-10-20T12:27:20.000000Z",
            "updated_at": "2022-10-20T12:27:20.000000Z"
        },
        {
            "id": 6,
            "name": "new Task Updateee222",
            "deadline": "2022-10-24",
            "description": "it is description,it is description2222",
            "user_id": 2,
            "status": "Ready",
            "created_at": "2022-10-20T12:27:51.000000Z",
            "updated_at": "2022-10-20T12:27:51.000000Z"
        }
    ]
}

return error{
User Not found
}

7.GET - {{url}}/api/tasks-history история update тасков

return success{
     "data": [
        {
            "id": 2,
            "task_id": 5,
            "updated": "{\"name\": \"new Task By Update\", \"status\": \"Ready\", \"user_id\": \"2\", \"deadline\": \"2022-10-24\", \"description\": \"it is description,it is description2222\"}",
            "created_at": "2022-10-20T12:35:31.000000Z",
            "updated_at": "2022-10-20T12:35:31.000000Z"
        },
        {
            "id": 3,
            "task_id": 6,
            "updated": "{\"name\": \"new Task By Update 6666\", \"status\": \"Ready\", \"user_id\": \"2\", \"deadline\": \"2022-10-24\", \"description\": \"it is description,it is description2222\"}",
            "created_at": "2022-10-20T12:36:29.000000Z",
            "updated_at": "2022-10-20T12:36:29.000000Z"
        }
    ]
}

7.GET - {{url}}/api/tasks-history/{task} ({task} - id таска) история update тасков очередного таска

return success{
      "data": [
        {
            "id": 2,
            "task_id": 5,
            "updated": "{\"name\": \"new Task By Update\", \"status\": \"Ready\", \"user_id\": \"2\", \"deadline\": \"2022-10-24\", \"description\": \"it is description,it is description2222\"}",
            "created_at": "2022-10-20T12:35:31.000000Z",
            "updated_at": "2022-10-20T12:35:31.000000Z"
        }
    ]
}


Все запросы кроме login и register проверяютса по Bearer token который генерируетса при логине добавти Authentication => Bearer (Postman) противном случие выдает ошибку Unauthenticated