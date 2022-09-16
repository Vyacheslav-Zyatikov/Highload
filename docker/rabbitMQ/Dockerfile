FROM rabbitmq:3.10.7-management-alpine

ENV RABBITMQ_USER gfcams
ENV RABBITMQ_PASSWORD fpZ4!-26ZGya
ENV RABBITMQ_PID_FILE /var/lib/rabbitmq/mnesia/rabbitmq

ADD init.sh /init.sh
RUN chmod +x /init.sh
EXPOSE 15672

CMD ["/init.sh"]