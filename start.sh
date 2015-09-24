#! /usr/bin/env bash

# :: set a default listening port
if [[ -z "$FOREXBOT_APP_PORT" ]]; then
  FOREXBOT_APP_PORT=8000
fi

# :: create a docker image if it does not exist yet
docker build -t rizzarizzarizza/forexbot .

# ::  run the app
docker run -d \
  -p $FOREXBOT_APP_PORT:80 \
  --name forexbot \
  rizzarizzarizza/forexbot