#!/bin/bash
count="${1:-3000}"
peer_second="${2:-100}"
ab -T application/x-www-form-urlencoded -p /var/www/ab/request.test -n $count -c $peer_second http://nginx/api/index
