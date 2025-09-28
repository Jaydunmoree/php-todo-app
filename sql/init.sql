CREATE TABLE IF NOT EXISTS task (
  task_id SERIAL PRIMARY KEY,
  task VARCHAR(250) NOT NULL,
  status VARCHAR(30) NOT NULL
);

INSERT INTO task (task, status) VALUES
('Read an article on React.js', 'Done'),
('Organize a meeting', 'Pending');
