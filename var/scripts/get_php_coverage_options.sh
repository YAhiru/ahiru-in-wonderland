#!/bin/sh

PCOV_OPTIONS="-dpcov.enabled=1 -dpcov.directory=. -dpcov.exclude=\"~(.github|bin|vendor|public|tests|var)~\"";

if [ "$(php -m | grep pcov)" != "" ]; then
  OPTIONS=$PCOV_OPTIONS;
elif [ "$(php -m | grep xdebug)" != "" ]; then
  OPTIONS="";
elif [ "$(php -dextension=pcov.so -m | grep pcov)" != "" ]; then
  OPTIONS="-dextension=pcov.so $PCOV_OPTIONS";
else
  OPTIONS="-dzend_extension=xdebug.so";
fi;

echo $OPTIONS
