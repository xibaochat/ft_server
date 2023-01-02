<h1 align="center">
   <b font size="15" face="arial" ><br><br>ft_server</font></b></h1>
   <p align="center">
  My first Web Server with Docker. LEMP development (Linux, Nginx, MySql, Php) 
  The goal of ft_server is to create a web server with <b> Nginx</b> capable of running a <b>WordPress</b> website, <b>phpMyAdmin</b> and a <b>MySQL</b> database. This server will run in only one Dockek
   container, under Debian Buster.
   </b>
   
  </a></br>
  <p align="center">
  <img src="https://img.shields.io/badge/docker-007ACC?style=for-the-badge&logo=docker&logoColor=white"></p>
  <table align="center">
<td>
 <b face="arial" >final mark<br><br></font></b></p>
 <img src="https://github.com/xibaochat/ft_server/blob/master/ft_server_final_mark.png">
 

</td>

<td>

| interest                     | number of team          | difficulty                      |
| ---------------------------- | ----------              | ----------                      |
|    :star::star::star::star:: | :cat: |  :star::star::star: |

</td>
</tr>
</table>


![index](https://github.com/xibaochat/ft_server/blob/master/index.png)

## Subject
[en.subject.pdf](https://github.com/xibaochat/ft_server/blob/master/en.subject.pdf)


# Instructions 👈
### 🔧 Installation 
```
git clone https://github.com/xibaochat/ft_server.git && cd ft_server
```
### 📦 Content  
* ```Dockerfile``` (contains the instructions for building the webserver's docker image)

* ```srcs/``` (contains configs and some bash scripts)


### 🔨 Build Docker image
```
docker build -t ft_server .
```
### 🏃 Run a container
```
docker run --name ft_server -d -p 443:443 -p 80:80 ft_server
```
### 🐚 Shell acces to the container
```
docker exec -it ft_server bash
```


|Services    |Path|image|
|:----------:|:-------:|:-------:|
|WordPress   |```http:localhost/wordpress```|![homepage](https://github.com/xibaochat/ft_server/blob/master/homepage.png)|
|phpMyAdmin  |```http:localhost/phpmyadmin```| ![phomyadmin](https://github.com/xibaochat/ft_server/blob/master/phpmyadmin.png)|




