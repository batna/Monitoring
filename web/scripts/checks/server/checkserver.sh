#!/bin/bash
area=3
rand=`head -1 /dev/urandom | od -N 1 | awk '{ print $2 }'`
nombre=`expr $rand % $area`
case $nombre in
	0) exit 0 ;;
	1) exit 1 ;;
	2) exit 2 ;;
esac