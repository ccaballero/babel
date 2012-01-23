#!/bin/bash

#Change for directories
find . -type d -exec chmod 755 -c {} \;

#Change for files
find . -type f -exec chmod 644 -c {} \;

