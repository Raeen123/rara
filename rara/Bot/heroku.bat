@echo off
::Config first push to heroku
cd src
git add .
git commit -am "make it better"
git push heroku master
git checkout -b main
git branch -D master