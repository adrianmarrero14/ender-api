window.onload = function() {
  //<editor-fold desc="Changeable Configuration Block">

  // the following lines will be replaced by docker/configurator, when it runs in a docker-container
  window.ui = SwaggerUIBundle({
    url: "/storage/api-docs/api-docs.json",
    dom_id: '#swagger-ui',

  });

  //</editor-fold>
};
