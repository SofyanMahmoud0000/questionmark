---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#Change Email 
We change the email here
<!-- START_ae62fc63378feeda6d6b26039d6462a9 -->
## changeemail
> Example request:

```bash
curl -X GET -G "http://localhost/changeemail?email=7" 
```

```javascript
const url = new URL("http://localhost/changeemail");

    let params = {
            "email": "7",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET changeemail`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    email |  required  | The new email the usr want to connect with his account.

<!-- END_ae62fc63378feeda6d6b26039d6462a9 -->

#Create User
We create the new user in this class
<!-- START_41ec161bb0631a5e8679f86e04fd290e -->
## signup
> Example request:

```bash
curl -X POST "http://localhost/signup?email=doloribus&password=eligendi&password_confirmation=in&name=similique" 
```

```javascript
const url = new URL("http://localhost/signup");

    let params = {
            "email": "doloribus",
            "password": "eligendi",
            "password_confirmation": "in",
            "name": "similique",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST signup`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    email |  required  | 
    password |  required  | 
    password_confirmation |  required  | 
    name |  required  | 

<!-- END_41ec161bb0631a5e8679f86e04fd290e -->

#Image 
We add and delete the image here
<!-- START_5208d248099fa73188461a192a408072 -->
## changeimage
<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST "http://localhost/changeimage?image=voluptatem" 
```

```javascript
const url = new URL("http://localhost/changeimage");

    let params = {
            "image": "voluptatem",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST changeimage`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    image |  required  | 

<!-- END_5208d248099fa73188461a192a408072 -->

<!-- START_9e3a54a272d54a2dfefbb77b2eda7d7e -->
## deleteimage
<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET -G "http://localhost/deleteimage" 
```

```javascript
const url = new URL("http://localhost/deleteimage");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET deleteimage`


<!-- END_9e3a54a272d54a2dfefbb77b2eda7d7e -->

#control 
We control and setting the user here
<!-- START_cb859c8e84c35d7133b6a6c8eac253f8 -->
## home
<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET -G "http://localhost/home" 
```

```javascript
const url = new URL("http://localhost/home");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET home`


<!-- END_cb859c8e84c35d7133b6a6c8eac253f8 -->

<!-- START_568bd749946744d2753eaad6cfad5db6 -->
## logout
<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET -G "http://localhost/logout" 
```

```javascript
const url = new URL("http://localhost/logout");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET logout`


<!-- END_568bd749946744d2753eaad6cfad5db6 -->

<!-- START_b2fc670627439711d7a6aa4b696a7ac9 -->
## changename
<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET -G "http://localhost/changename?name=qui" 
```

```javascript
const url = new URL("http://localhost/changename");

    let params = {
            "name": "qui",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET changename`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    name |  required  | 

<!-- END_b2fc670627439711d7a6aa4b696a7ac9 -->

<!-- START_0d6e571e0124de04ada2761f5ea7d533 -->
## changepassword
<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST "http://localhost/changepassword?currentPassword=distinctio&newPassword=alias&newPassword_confirmation=laborum" 
```

```javascript
const url = new URL("http://localhost/changepassword");

    let params = {
            "currentPassword": "distinctio",
            "newPassword": "alias",
            "newPassword_confirmation": "laborum",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST changepassword`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    currentPassword |  required  | 
    newPassword |  required  | 
    newPassword_confirmation |  required  | 

<!-- END_0d6e571e0124de04ada2761f5ea7d533 -->

#sign in 
we sign in the website here
<!-- START_093ec7e72da3a515f4f1521e292fe92c -->
## signin
> Example request:

```bash
curl -X POST "http://localhost/signin?email=temporibus&password=debitis" 
```

```javascript
const url = new URL("http://localhost/signin");

    let params = {
            "email": "temporibus",
            "password": "debitis",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST signin`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    email |  required  | 
    password |  required  | 

<!-- END_093ec7e72da3a515f4f1521e292fe92c -->


