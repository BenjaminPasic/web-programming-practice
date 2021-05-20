<?php

class Config{

    const DB_HOST = 'localhost';
    const DB_USERNAME = 'root';
    const DB_NAME = 'projectpractice';
    const DB_PASSWORD = 'abc123';

    const JWT_TOKEN_TIME = 9000;
    const JWT_SECRET = 'verysecretkey';

    const DATE_FORMAT = "Y-m-d H:i:s";

    //Gmail SMTP setup
    const SMTP_HOST = 'smtp.gmail.com';
    const SMTP_PORT = "465";
    const SMTP_EMAIL = "emilsenderweb@gmail.com";
    const SMTP_PASSWORD = "amdpulse";

    
}