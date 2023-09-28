# Use the official Node.js image as the base image
FROM node:18.17.1

# Set the working directory inside the container
WORKDIR /app

# Copy package.json and package-lock.json to the working directory
COPY package*.json ./

# Install project dependencies
RUN npm install

# Copy the rest of the application code to the working directory
COPY . .

# Expose the port that the application will run on
EXPOSE 19000
EXPOSE 19001
EXPOSE 19002

# Start the application using the expo-cli binary
CMD ["npx","expo", "start"]

