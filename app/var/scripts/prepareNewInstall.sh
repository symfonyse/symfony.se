#!/bin/sh

#
# @Author Tobias Nyholm
#
#

FOLDERS="app/cache app/logs app/var/sessions web/uploads"

remove_existing_content() {
    # remove exiting cache and logs
    rm -rf app/cache/*
    rm -rf app/logs/*
}

file_permissions_mac() {
    # MAC
    if [ $# -eq 1 ]; then
        APACHEUSER=$1
    else
        APACHEUSER=`ps aux | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data' | grep -v root | head -1 | cut -d\  -f1`
    fi

    remove_existing_content
    print_user_info $APACHEUSER
    ask_for_root_password
    sudo chmod +a "$APACHEUSER allow delete,write,append,file_inherit,directory_inherit" $FOLDERS
    sudo chmod +a "`whoami` allow delete,write,append,file_inherit,directory_inherit" $FOLDERS
}

file_permissions_linux() {
    #Linux
    if [ $# -eq 1 ]; then
        APACHEUSER=$1
    else
        APACHEUSER=`ps aux | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data' | grep -v root | head -1 | cut -d\  -f1`
    fi

    remove_existing_content
    print_user_info $APACHEUSER
    ask_for_root_password
    sudo setfacl -R -m u:"$APACHEUSER":rwX -m u:`whoami`:rwX $FOLDERS
    sudo setfacl -dR -m u:"$APACHEUSER":rwX -m u:`whoami`:rwX $FOLDERS
}

file_permissions_windows() {
    #Windows
    echo "No, just no..."
}

ask_for_root_password() {
    echo "I need your root password. Trust me ;)"
}

print_user_info() {
    echo "Setting up permissions for you (`whoami`) and '$1'"
}

case "$1" in
mac)
        file_permissions_mac $2
        ;;

linux)
        file_permissions_linux $2
        ;;
windows)
        file_permissions_windows
        ;;
*)
        echo "Usage: sh app/var/scripts/pepareNewInstall.sh {mac|linux|windows} [username]"
        exit 1
        ;;
esac

exit 0