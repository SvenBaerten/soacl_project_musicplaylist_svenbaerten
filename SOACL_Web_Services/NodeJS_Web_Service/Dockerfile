# Based on https://nodejs.org/de/docs/guides/nodejs-docker-webapp/

# Use an official Node.js runtime as a parent image
FROM node:12-alpine

# Create app directory
WORKDIR /usr/src/app

# Install app dependencies
# A wildcard is used to ensure both package.json AND package-lock.json are copied
# where available (npm@5+)
COPY package*.json ./

RUN npm install --only=production

# Bundle app source
COPY . .

# Port to the outside world
EXPOSE 80

# Start command
CMD [ "npm", "start" ]
