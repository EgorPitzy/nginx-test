FROM node:18

WORKDIR /opt/app

COPY package*.json ./

RUN yarn

COPY . .

RUN yarn build

CMD [ "yarn", "run", "start:dev" ]
