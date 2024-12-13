
CREATE DATABASE IF NOT EXISTS comp1841 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE comp1841;

CREATE TABLE people (
    id INT(11) NOT NULL AUTO_INCREMENT,  -- Primary key for users
    name VARCHAR(255) NOT NULL,          -- User name
    email VARCHAR(255) NOT NULL UNIQUE,  -- Email must be unique
    PRIMARY KEY (id)                     -- Primary key constraint
);

-- Create the `module` table
CREATE TABLE module (
    id INT(11) NOT NULL AUTO_INCREMENT,  -- Primary key for modules
    modulename VARCHAR(255) NOT NULL,          -- Module name
    PRIMARY KEY (id)                     -- Primary key constraint
);

-- Create the `post` table
CREATE TABLE post (
    id INT(11) NOT NULL AUTO_INCREMENT,      -- Primary key for posts
    posttext TEXT NOT NULL,                  -- Post content
    postdate DATE NOT NULL,                  -- Date of the post
    post_pic BLOB,                           -- Optional image for the post
    peopleid INT(11) NOT NULL,                 -- Foreign key referencing `user.id`
    moduleid INT(11) NOT NULL,               -- Foreign key referencing `module.id`
    PRIMARY KEY (id),                        -- Primary key constraint
    CONSTRAINT post_ibfk_1 FOREIGN KEY (peopleid) REFERENCES people (id) ON DELETE CASCADE,
    CONSTRAINT post_ibfk_2 FOREIGN KEY (moduleid) REFERENCES module (id) ON DELETE CASCADE
);

-- Create the `postmodule` table (if required by design)
-- This table links posts and modules, but it appears redundant since `moduleid` is in the `post` table
CREATE TABLE postmodule (
    postid INT(11) NOT NULL,                 -- Foreign key referencing `post.id`
    moduleid INT(11) NOT NULL,               -- Foreign key referencing `module.id`
    PRIMARY KEY (postid, moduleid),          -- Composite primary key
    CONSTRAINT postmodule_ibfk_1 FOREIGN KEY (postid) REFERENCES post (id) ON DELETE CASCADE,
    CONSTRAINT postmodule_ibfk_2 FOREIGN KEY (moduleid) REFERENCES module (id) ON DELETE CASCADE
);
