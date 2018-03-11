#!/bin/bash
# this is just used to "correctly" start our daemons
# the actual daemon scripts are wonky as hell and don't correctly work under ubuntu 16.04
# this is a TODO item
echo -e " * \e[92mStarting\e[37m: fornite-statsupdate"
nohup bash daemon-status.sh start > /dev/null 2>&1 &
echo -e " * \e[92mStarting\e[37m: fornite-winwatcher"
nohup bash daemon-wins.sh start > /dev/null 2>&1 &
