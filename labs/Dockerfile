FROM node:latest

LABEL authors="Suraches <s.suraches@hotmail.com>"

RUN mkdir -p /opt/app/
ENV TERM=xterm APP=/opt/app

WORKDIR $APP
ADD package.json $APP/

RUN npm install

COPY . $APP/
COPY .env.example.docker ./.env

CMD ["npm", "start"]